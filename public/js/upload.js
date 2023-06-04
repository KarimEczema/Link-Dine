

const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co'
const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw'

var supabase = supabase.default(supabaseUrl, supabaseAnonKey);


document.getElementById('image_uploads').addEventListener('change', function() {
    var file = this.files[0]; // get the uploaded file

    // check if a file is selected
    if (file) {
        var reader = new FileReader();
        reader.onloadend = function() {
            // when the file is read, set the src of the image
            document.getElementById('preview').src = reader.result;
            document.getElementById('preview').style.display = 'block';
        }
        reader.readAsDataURL(file); // read the uploaded file
    }
});

document.getElementById('publish_button').addEventListener('click', async function() {
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

        const { data, error } = await supabase
            .storage
            .from('uploads')
            .upload(file.name, file);

        if (error) {
            console.error('Upload error: ', error.message);
            alert('Error uploading file.');
        } else {
            console.log('File uploaded: ', data);
            alert('File successfully uploaded.');
        }
    } else {
        alert('Please choose a file to upload.');
    }
});

async function listFiles() {
    try {
        const { data, error } = await supabase
            .storage
            .from('Images')
            .list('')
        
        if (error) throw error;
        
        console.log(data);
    } catch (error) {
        console.error('Error:', error);
    }
}

async function uploadFile(filePath, fileContent) {
    try {
        let { data, error } = await supabase
            .storage
            .from('Images')
            .upload(filePath, fileContent);

        if (error) throw error;

        console.log("File uploaded:", data);
    } catch (error) {
        console.error('Error:', error);
    }
}

async function downloadFile(filePath) {
    try {
        const { data, error } = await supabase
            .storage
            .from('Images')
            .download(filePath);

        if (error) throw error;

        // `data` contains the downloaded file as a Blob. 
        // Here, we're just logging the Blob's size, but you could do other things with it.
        console.log("Downloaded file size:", data.size);
    } catch (error) {
        console.error('Error:', error);
    }
}


