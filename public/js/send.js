const { createClient } = require("@supabase/supabase-js");

const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co';
const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw'
const supabase = createClient(supabaseUrl, supabaseAnonKey);

module.exports = async (req, res) => {
  const { username, message } = req.body;
  let { data, error } = await supabase
    .from('messages')
    .insert([
      { username: username, message: message },
    ]);

  if (error) {
    return res.status(500).json({ error: error.message });
  }

  res.json({ data });
};

