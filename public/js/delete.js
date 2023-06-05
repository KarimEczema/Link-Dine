import { createClient } from "@supabase/supabase-js";


const supabaseUrl = 'https://bmqgiyygwjnnfyrtjkno.supabase.co';
const supabaseAnonKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJtcWdpeXlnd2pubmZ5cnRqa25vIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODUzNzM1NzcsImV4cCI6MjAwMDk0OTU3N30.sQgvRElC6O5e4uE8OVZqLXBiQYQa83mSkTy4s4L0aDw'
const supabase = createClient(supabaseUrl, supabaseAnonKey);

async function deleteRow(table, row) {
  try {
    const { data, error } = await supabase
      .from(table)
      .delete()
      .eq('idUser', row)

    if (error) {
      console.log('Error: ', error);
    } else {
      console.log('Deleted: ', data);
    }
  } catch (error) {
    console.error('Unexpected error', error);
  }
}


async function getUserIdFromUsername(table, username) {
  try {
    const { data, error } = await supabase
      .from(table)
      .select('idUser')  // assuming 'idUser' is the column for user ids
      .eq('username', username)  // assuming 'username' is the column for usernames

    if (error) {
      console.error('Error: ', error);
      return null;
    } else if (data && data.length > 0) {
      console.log('User ID: ', data[0].idUser);
      return data[0].idUser;  // returning the first match
    } else {
      console.log('No user found with this username');
      return null;
    }
  } catch (error) {
    console.error('Unexpected error', error);
    return null;
  }
}

