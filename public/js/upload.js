
import { createClient } from 'https://cdn.skypack.dev/@supabase/supabase-js';

const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co'
const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw'

const supabase = createClient(supabaseUrl, supabaseAnonKey);

function previewImage() {
    var file = document.getElementById('image_uploads').files[0];
    if (file) {
        var reader = new FileReader();
        reader.onloadend = function () {
            document.getElementById('preview').src = reader.result;
            document.getElementById('preview').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

document.getElementById('image_uploads').addEventListener('change', function () {
    var file = this.files[0]; // get the uploaded file

    // check if a file is selected
    if (file) {
        var reader = new FileReader();
        reader.onloadend = function () {
            // when the file is read, set the src of the image
            document.getElementById('preview').src = reader.result;
            document.getElementById('preview').style.display = 'block';
        }
        reader.readAsDataURL(file); // read the uploaded file
    }
});

document.querySelector('form').addEventListener('submit', async function (event) {
    event.preventDefault();

    var fileInput = document.getElementById('image_uploads');
    var file = fileInput.files[0];

    if (file) {
        if (file.size > 5000000) { // limiting to 5MB
            alert("File is too large to upload. Please choose a file smaller than 5MB.");
            return;
        }

        let allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // allowed file extensions
        if (!allowedExtensions.exec(file.name)) {
            alert('Invalid file type. Only .jpg, .jpeg, .png files are allowed.');
            return;
        }

        let sanitizedFileName = sanitizeFilename(file.name);
        const { data, error } = await supabase
            .storage
            .from('Images') // replace with your bucket name
            .upload('post/' + sanitizedFileName, file, {upsert: true});


        if (error) {
            console.error('Upload error: ', error.message);
            var storageBaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/public/';
            var fullUrl = storageBaseUrl + 'Images/post/' + sanitizedFileName;
            document.getElementById('image_url').value = fullUrl;
        } else {
            // Construct the full URL of the uploaded file
            var storageBaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co/storage/v1/object/public/';
            var fullUrl = storageBaseUrl + 'Images/post/' + sanitizedFileName;

            // Save the full URL of the uploaded file in the hidden input
            document.getElementById('image_url').value = fullUrl;
            console.log('File uploaded: ', data);
            alert('File successfully uploaded.');
            event.target.submit(); // submit the form after the image is uploaded
        }
    } else {
        alert('Please choose a file to upload.');
    }
});

function sanitizeFilename(filename) {
    return filename.replace(/[^\w.]/gi, '_');  // replaces all non-alphanumeric and non-dot characters with underscores
}

