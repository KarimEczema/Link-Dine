

const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co'
const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw'

const supabase = createClient(supabaseUrl, supabaseAnonKey)

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


