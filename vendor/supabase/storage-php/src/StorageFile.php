<?php

/**
 * A PHP  class  client library to interact with Supabase Storage.
 *
 * Provides functions for handling storage buckets Files.
 */

namespace Supabase\Storage;

use Bayfront\MimeTypes\MimeType;
use League\Uri\Http;
use Psr\Http\Message\ResponseInterface;
use Supabase\Storage\Util\Constants;
use Supabase\Storage\Util\FileHandler;
use Supabase\Storage\Util\Request;

class StorageFile
{
	/**
	 * A RESTful endpoint for querying and managing your database.
	 *
	 * @var string
	 */
	protected string $url;

	/**
	 * A header Bearer Token generated by the server in response to a login request
	 * [service key, not anon key].
	 *
	 * @var array
	 */
	protected array $headers = [];

	/**
	 * The bucket id to operate on.
	 *
	 * @var string
	 */
	protected string $bucketId;

	protected array $DEFAULT_SEARCH_OPTIONS = [
		'limit' => 100,
		'offset' => 0,
		'sortBy' => [
			'column' => 'name',
			'order' => 'asc',
		],
	];

	protected $DEFAULT_FILE_OPTIONS = [
		'cacheControl' => 3600,
		'upsert' => false,
		'contentType' => 'text/plain;charset=UTF-8',
	];

	/**
	 * Get the url.
	 */
	public function __getUrl(): string
	{
		return $this->url;
	}

	/**
	 * Get the headers.
	 */
	public function __getHeaders(): array
	{
		return $this->headers;
	}

	public function __getBucketId(): string
	{
		return $this->bucketId;
	}

	/**
	 * StorageFile constructor.
	 *
	 * @param  string  $api_key  The anon or service role key
	 * @param  string  $reference_id  Reference ID
	 * @param  string  $domain  The domain pointing to api
	 * @param  string  $scheme  The api sheme
	 * @param  string  $path  The path to api
	 *
	 * @throws Exception
	 */
	public function __construct($api_key, $reference_id, $bucketId, $domain = 'supabase.co', $scheme = 'https', $path = '/storage/v1')
	{
		$headers = ['Authorization' => "Bearer {$api_key}"];
		$this->headers = array_merge(Constants::getDefaultHeaders(), $headers);

		$this->url = "{$scheme}://{$reference_id}.{$domain}{$path}";
		$this->bucketId = $bucketId;
	}

	public function __request($method, $url, $headers, $body = null): ResponseInterface
	{
		return Request::request($method, $url, $headers, $body);
	}

	/**
	 * Lists all the files within a bucket.
	 *
	 * @param  string  $path  The folder path.
	 * @param  array  $options  The options for list files.
	 * @return ResponseInterface
	 *
	 * @throws Exception
	 */
	public function list($path, $opts = []): ResponseInterface
	{
		$headers = $this->headers;
		try {
			$prefix = [
				'prefix' => $path,
			];
			$opts = $this->DEFAULT_SEARCH_OPTIONS;
			$body = array_merge($prefix, $opts);

			$data = $this->__request('POST', $this->url.'/object/list/'.$this->bucketId, $headers, json_encode($body));

			return $data;
		} catch (\Exception $e) {
			throw $e;
		}
	}

	/**
	 * Uploads a file to an object storage bucket creating or replacing the file if it already exists.
	 *
	 * @param  string  $method  The HTTP method to use for the request.
	 * @param  string  $path  path The file path, including the file name. Should be of
	 *                        the format `folder/subfolder/filename.png`.
	 *                        Bucket must already exist.
	 * @param  string  $file  The url, file path or contents of the file to store in the bucket.
	 * @param  array  $options  The options for the upload.
	 * @return ResponseInterface
	 *
	 * @throws Exception
	 */
	public function uploadOrUpdate($method, $path, $file, $opts): ResponseInterface
	{
		$options = array_merge($this->DEFAULT_FILE_OPTIONS, $opts);
		$headers = $this->headers;

		if ($method == 'POST') {
			$headers['x-upsert'] = $options['upsert'] ? 'true' : 'false';
		}

		$headers['Content-Type'] = $this->determineFileType($path);
		$storagePath = $this->_storagePath($path);

		// If the $file exists or is a URL
		if (file_exists($file) === true || $this->isUrl($file) === true) {
			try {
				$body = FileHandler::getFileContents($file);
			} catch (\Exception $e) {
				throw $e;
			}
		} else {
			// Assume the $file is string of file contents
			$body = $file;
		}

		try {
			$data = $this->__request($method, $this->url.'/object/'.$storagePath, $headers, $body);

			return $data;
		} catch (\Exception $e) {
			throw $e;
		}
	}

	/**
	 * Determine the file type based on file name.
	 *
	 * @param  string  $fileName  Name of the file
	 * @return string
	 */
	public function determineFileType($fileName): string
	{
		return MimeType::fromFile($fileName);
	}

	/**
	 * Determine if the file is a URL.
	 *
	 * @param  string  $fileName  Name of the file
	 * @return bool
	 */
	public function isUrl($fileName): bool
	{
		try {
			Http::createFromString($fileName);
		} catch (\Exception $e) {
			return false;
		}

		return true;
	}

	/**
	 * Uploads a file to an existing bucket.
	 *
	 * @param  string  $path  path The file path, including the file name. Should be of
	 *                        the format `folder/subfolder/filename.png`.
	 *                        Bucket must already exist.
	 * @param  string  $file  The url, file path or contents of the file to store in the bucket.
	 * @param  array  $options  The options for the upload.
	 * @return ResponseInterface
	 *
	 * @throws Exception
	 */
	public function upload($path, $file, $opts): ResponseInterface
	{
		return $this->uploadOrUpdate('POST', $path, $file, $opts);
	}

	/**
	 * Replaces an existing file at the specified path with a new one.
	 *
	 * @param  string  $path  path The file path, including the file name. Should be of
	 *                        the format `folder/subfolder/filename.png`.
	 *                        Bucket must already exist.
	 * @param  string  $file  The url, file path or contents of the file to store in the bucket.
	 * @param  array  $options  The options for the update.
	 * @return ResponseInterface
	 *
	 * @throws Exception
	 */
	public function update($path, $file, $opts): ResponseInterface
	{
		return $this->uploadOrUpdate('PUT', $path, $file, $opts);
	}

	/**
	 * Moves an existing file to a new path in the same bucket.
	 *
	 * @param  string  $fromPath  The original file path, including the current file
	 *                            name. For example `folder/image.png`.
	 * @param  string  $toPath  The new file path, including the new file name.
	 *                          For example `folder/image-new.png`.
	 * @return ResponseInterface
	 *
	 * @throws Exception
	 */
	public function move($fromPath, $toPath): ResponseInterface
	{
		$headers = $this->headers;
		$body = [
			'bucketId' => $this->bucketId,
			'sourceKey' => $fromPath,
			'destinationKey' => $toPath,
		];
		try {
			$data = $this->__request('POST', $this->url.'/object/move', $headers, json_encode($body));

			return $data;
		} catch (\Exception $e) {
			throw   $e;
		}
	}

	/**
	 * Copies an existing file to a new path in the same bucket.
	 *
	 * @param  string  $fromPath  The original file path, including the current
	 *                            file name. For example `folder/image.png`.
	 * @param  string  $toPath  The new file path, including the new file name.
	 *                          For example `folder/image-copy.png`.
	 * @return ResponseInterface
	 *
	 * @throws Exception
	 */
	public function copy($fromPath, $toPath): ResponseInterface
	{
		$headers = $this->headers;
		try {
			$body = [
				'bucketId' => $this->bucketId,
				'sourceKey' => $fromPath,
				'destinationKey' => $toPath,
			];

			$data = $this->__request('POST', $this->url.'/object/copy', $headers, json_encode($body));

			return $data;
		} catch (\Exception $e) {
			throw $e;
		}
	}

	/**
	 * Creates a signed URL. Use a signed URL to share a file for a fixed amount of time.
	 *
	 * @param  string  $path  The file path, including the current file name. For example `folder/image.png`.
	 * @param  int  $expiresIn  The number of seconds until the signed URL expires. For example,
	 *                          `60` for a URL which is valid for one minute
	 * @param  array  $opts['download']  Triggers the file as a download if set to true. Set
	 *                                   this parameter as the name of the file if you want to trigger the download with a different filename.
	 * @param  array  $opts['transform']  Transform the asset before serving it to the client.
	 * @return string
	 */
	public function createSignedUrl($path, $expires): ResponseInterface
	{
		$headers = $this->headers;

		try {
			$body = [
				'expiresIn' => $expires,
				'transform' => [
					'height' => 100,
					'width' => 100,
					'resize' => 'cover',
					'format' => 'origin',
					'quality' => 100,
				],
			];
			$storagePath = $this->_storagePath($path);
			$fullUrl = $this->url.'/object/sign/'.$storagePath;
			$data = $this->__request('POST', $fullUrl, $headers, json_encode($body));

			return  $data;
		} catch (\Exception $e) {
			throw $e;
		}
	}

	/**
	 * Creates a signed URL. Use a signed URL to share a file for a fixed amount of time.
	 *
	 * @param  string  $paths  The file path, including the current file name. For example `folder/image.png`.
	 * @param  int  $expiresIn  The number of seconds until the signed URL expires.
	 *                          For example, `60` for a URL which is valid for one minute.
	 * @param  array  $opts['download']  Triggers the file as a download if set to true. Set
	 *                                   this parameter as the name of the file if you want to trigger the download with a different filename.
	 * @param  array  $opts['transform']  Transform the asset before serving it to the client.
	 * @return array
	 */
	public function createSignedUrls($paths, $expiresIn, $opts): array
	{
		$headers = $this->headers;

		try {
			$body = [
				'paths' => $paths,
				'expiresIn' => $expiresIn,
				'options' => $opts,
			];
			$fullUrl = $this->url.'/object/sign/'.$this->bucketId;
			$response = $this->__request('POST', $fullUrl, $headers, json_encode($body));
			$downloadQueryParam = isset($opts['download']) ? '?download=true' : '';
			$data = array_map(function ($d) use ($downloadQueryParam) {
				$d['signedURL'] = urldecode($this->url.$d['signedURL'].$downloadQueryParam);

				return $d;
			}, json_decode($response->getBody(), true));

			return $data;
		} catch (\Exception $e) {
			throw $e;
		}
	}

	/**
	 * Downloads a file from a private bucket. For public buckets, make
	 * a request to the URL returned from `getPublicUrl` instead.
	 *
	 * @param  string  $path  The full path and file name of the file to be downloaded.
	 *                        For example `folder/image.png`.
	 * @param  array  $options['transform']  Transform the asset before serving it to the client.
	 * @return ResponseInterface
	 *
	 * @throws Exception
	 */
	public function download($path, $opts = []): ResponseInterface
	{
		$headers = array_merge($this->headers, ['stream' => true]);

		$transformOptions = isset($opts['transform']) ? $opts['transform'] : [];
		$renderPath = isset($opts['transform']) ? 'render/image/authenticated' : 'object';
		$transformationQuery = $this->transformOptsToQueryString($transformOptions);
		$queryString = ($transformationQuery != '') ? '?'.$transformationQuery : '';
		$url = $this->url.'/'.$renderPath.'/'.$this->bucketId.'/'.$path.$queryString;

		try {
			return $this->__request('GET', $url, $headers);
		} catch (\Exception $e) {
			throw $e;
		}
	}

	/**
	 * A simple convenience function to get the URL for an asset in a
	 * public bucket. If you do not want to use this function, you can
	 * construct the public URL by concatenating the bucket URL with
	 * the path to the asset.
	 * This function does not verify if the bucket is public.
	 * If a public URL is created for a bucket which is not public,
	 * you will not be able to download the asset.
	 *
	 * @param  string  $path  The path and name of the file to generate
	 *                        the public URL for. For example `folder/image.png`.
	 * @param  array  $options['download']  Triggers the file as a download
	 *                                      if set to true. Set this parameter as the name of the file if you want
	 *                                      to trigger the download with a different filename.
	 * @param  array  $options['transform']  Transform the asset before serving
	 *                                       it to the client.
	 * @return string
	 */
	public function getPublicUrl($path, $opts = []): string
	{
		$storagePath = $this->_storagePath($path);
		$_queryString = [];
		$headers = $this->headers;

		$downloadQueryParam = isset($opts['download']) ? 'download=true' : '';
		if ($downloadQueryParam !== '') {
			array_push($_queryString, $downloadQueryParam);
		}

		$transformOptions = isset($opts['transform']) ? $opts['transform'] : [];
		$renderPath = isset($opts['transform']) ? 'render/image' : 'object';
		$transformationQuery = $this->transformOptsToQueryString($transformOptions);

		if ($transformationQuery !== '') {
			array_push($_queryString, $transformationQuery);
		}

		$queryString = implode('&', $_queryString);
		if ($queryString !== '') {
			$queryString = '?'.$queryString;
		}

		return urldecode($this->url.'/'.$renderPath.'/public/'.$storagePath.$queryString);
	}

	/**
	 * Deletes files within the same bucket.
	 *
	 * @param  string  $path  An array of files to delete,
	 *                        including the path and file name. For example [`'folder/image.png'`].
	 * @return ResponseInterface
	 *
	 * @throws Exception
	 */
	public function remove($paths): ResponseInterface
	{
		$headers = $this->headers;
		try {
			$body = ['prefixes' => $paths];
			$fullUrl = $this->url.'/object/'.$this->bucketId;
			$data = $this->__request('DELETE', $fullUrl, $headers, json_encode($body));

			return $data;
		} catch (\Exception $e) {
			throw $e;
		}
	}

	/**
	 * Cleans up the path to the file in the bucket.
	 *
	 * @param  string  $path  The path to the file in the bucket.
	 * @return string Returns the path to the file cleaned
	 */
	private function _storagePath($path): string
	{
		$p = preg_replace('/^\/|\/$/', '', $path);
		$p = preg_replace('/\/+/', '/', $p);

		return $this->bucketId.'/'.$p;
	}

	private function transformOptsToQueryString($transform = [])
	{
		$params = [];
		if (isset($transform['width'])) {
			array_push($params, "width={$transform['width']}");
		}

		if (isset($transform['height'])) {
			array_push($params, "height={$transform['height']}");
		}

		if (isset($transform['resize'])) {
			array_push($params, "resize={$transform['resize']}");
		}

		if (isset($transform['format'])) {
			array_push($params, "format={$transform['format']}");
		}

		if (isset($transform['quality'])) {
			array_push($params, "quality={$transform['quality']}");
		}

		return implode('&', $params);
	}
}
