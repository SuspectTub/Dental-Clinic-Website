

-- using MySql.Data.MySqlClient;



    
--         MySqlConnection con = new MySqlConnection("datasource=localhost;port=3306;username=root;password=");
--         MySqlCommand cmd;
--         MySqlDataAdapter adapt;
       

    
--         DisplayData();
      


-- === INSERT BUTTON (btnInsert)  
      
--         // Checks if Username Exists
--             MySqlCommand cmd1 = new MySqlCommand("SELECT * FROM accountinfo.userinfo WHERE Username = @UserName", con);
--             cmd1.Parameters.AddWithValue("@UserName", txtUsername.Text);
--             con.Open();
--             bool userExists = false;
--             using (var dr1 = cmd1.ExecuteReader())
--                 if (userExists = dr1.HasRows)
--                     MessageBox.Show("Username not available!", "ERROR", MessageBoxButtons.OK, MessageBoxIcon.Error);
--             con.Close();
--             if (!(userExists))
--             {
--          // Adds a User in the Database
--                 if (txtUsername.Text != "" && txtPassword.Text != "")
--                 {
--                     cmd = new MySqlCommand("insert into accountinfo.userinfo(ID,Username,Password) values(NULL,@name,@pass)", con);
--                     con.Open();
--                     cmd.Parameters.AddWithValue("@id", txtID.Text);
--                     cmd.Parameters.AddWithValue("@name", txtUsername.Text);
--                     cmd.Parameters.AddWithValue("@pass", txtPassword.Text);
--                     cmd.ExecuteNonQuery();
--                     con.Close();
--                     MessageBox.Show("Record Successfully Added", "INSERT", MessageBoxButtons.OK, MessageBoxIcon.Information);
--                     DisplayData();
--                     ClearData();
--                 }
--                 else
--                 {
--                     MessageBox.Show("Fill out all the information needed", "ERROR", MessageBoxButtons.OK, MessageBoxIcon.Error);
--                 }
--             }
        


-- ===> COPY FROM HERE ===>

-- // Displays the data in Data Grid View  
--         private void DisplayData()
--         {
--             con.Open();
--             DataTable dt = new DataTable();
--             adapt = new MySqlDataAdapter("select * from accountinfo.userinfo", con);
--             adapt.Fill(dt);
--             dataGridView1.DataSource = dt;
--             con.Close();
--         }
-- // Clears the Data  
--         private void ClearData()
--         {
--             txtID.Text = "";
--             txtUsername.Text = "";
--             txtPassword.Text = "";

--         }
-- <=== TO HERE <===



-- === UPDATE BUTTON (btnUpdate)
        
--             if (txtUsername.Text != "" && txtPassword.Text != "" && txtID.Text != "")
--             {
--                 cmd = new MySqlCommand("update accountinfo.userinfo set Username=@name, Password=@pass where ID=@id", con);
--                 con.Open();
--                 cmd.Parameters.AddWithValue("@id", txtID.Text);
--                 cmd.Parameters.AddWithValue("@name", txtUsername.Text);
--                 cmd.Parameters.AddWithValue("@pass", txtPassword.Text);
--                 cmd.ExecuteNonQuery();
--                 MessageBox.Show("Record Successfully Updated", "UPDATE", MessageBoxButtons.OK, MessageBoxIcon.Information);
--                 con.Close();
--                 DisplayData();
--                 ClearData();
--             }
--             else
--             {
--                 MessageBox.Show("Select the record you want to Update", "ERROR", MessageBoxButtons.OK, MessageBoxIcon.Error);
--             }


-- === DELETE BUTTON (btnDelete)

        
--             if (txtUsername.Text != "" && txtPassword.Text != "" && txtID.Text != "")
--             {
--                 cmd = new MySqlCommand("delete from accountinfo.userinfo where ID=@id", con);
--                 con.Open();
--                 cmd.Parameters.AddWithValue("@id",txtID.Text);
--                 cmd.ExecuteNonQuery();
--                 con.Close();
--                 MessageBox.Show("Record Successfully Deleted", "DELETE", MessageBoxButtons.OK, MessageBoxIcon.Information);
--                 DisplayData();
--                 ClearData();
--             }
--             else
--             {
--                 MessageBox.Show("Select the record you want to Delete", "ERROR", MessageBoxButtons.OK, MessageBoxIcon.Error);
--             }

        


-- === dataGridView1_RowHeaderMouseClick
--             txtID.Text = dataGridView1.Rows[e.RowIndex].Cells[0].Value.ToString();
--             txtUsername.Text = dataGridView1.Rows[e.RowIndex].Cells[1].Value.ToString();
--             txtPassword.Text = dataGridView1.Rows[e.RowIndex].Cells[2].Value.ToString();
        

