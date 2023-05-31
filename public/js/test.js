const fetch = require('node-fetch');

const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co';
const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw'


const sendMessage = async (username, message) => {
    try {
      const response = await fetch(`${supabaseUrl}/rest/v1/messages`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'apikey': supabaseAnonKey,
        },
        body: JSON.stringify({ username, message }),
      });
  
      if (!response.ok) {
        const errorMessage = await response.text();
        throw new Error(`Failed to send message: ${response.status}, ${errorMessage}`);
      }
  
      console.log('Message sent successfully');
    } catch (error) {
      console.error('Error:', error.message);
    }
  };
  sendMessage('john', 'Hello, world!');