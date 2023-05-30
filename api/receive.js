const { createClient } = require("@supabase/supabase-js");

const supabaseUrl = "your-supabase-url";
const supabaseAnonKey = "your-anonymous-key";
const supabase = createClient(supabaseUrl, supabaseAnonKey);

module.exports = async (_, res) => {
  let { data, error } = await supabase
    .from('messages')
    .select('*')
    .order('timestamp', { ascending: false });

  if (error) {
    return res.status(500).json({ error: error.message });
  }

  res.json({ data });
};
