const { createClient } = require("@supabase/supabase-js");

const supabaseUrl = "your-supabase-url";
const supabaseAnonKey = "your-anonymous-key";
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
