using System;
using System.Data;
using System.Configuration;
using System.Collections;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using System.Data.SqlClient;

public partial class MOMAdmin : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        foreach (object s in Request.ServerVariables)
        {
            Response.Write(s.ToString() + " " + Request.ServerVariables[s.ToString()] + "<br/>");
        }
        Response.Write("<br/>");

        Response.Write("hello " + Request.ServerVariables["HTTP_X_CLUSTER_CLIENT_IP"].ToString());

        //SqlConnection momConnection = new SqlConnection();
        ////momConnection.ConnectionString = "Data Source=mssql0805.wc2\\inst1;Initial Catalog=416142_Momburbia;Persist Security Info=True;User ID=416142_MOM_SYS;Password=MOM_SYSTEM";
        //momConnection.ConnectionString = "Data Source=prashant;Initial Catalog=Momburbia;Persist Security Info=True;User ID=sa;Password=jaihind7";

        //try
        //{
        //    momConnection.Open();
        //    momConnectionStatus.Text = "Successful";
        //}
        //catch (Exception X)
        //{
        //    momConnectionStatus.Text = X.Message;
        //}
    }
    protected void momSubmitDBScript_Click(object sender, EventArgs e)
    {
        //SqlConnection momConnection = new SqlConnection();
        //momConnection.ConnectionString = "Data Source=mssql0805.wc2\\inst1;Initial Catalog=416142_Momburbia;Persist Security Info=True;User ID=416142_MOM_SYS;Password=MOM_SYSTEM";
        ////momConnection.ConnectionString =
        //    //ConfigurationManager.ConnectionStrings["momConnectionString"].ConnectionString;
        //    //"Data Source=prashant;Initial Catalog=Momburbia;Persist Security Info=True;User ID=sa;Password=jaihind7";

        //try
        //{
        //    momConnection.Open();
        //    SqlCommand momCommand = new SqlCommand();
        //    momCommand.CommandText = momDBScript.Text;
        //    momCommand.Connection = momConnection;
        //    int affectedRows = momCommand.ExecuteNonQuery();
        //}
        //catch (Exception X)
        //{
        //    momConnectionStatus.Text = X.Message;
        //}
    }
}
