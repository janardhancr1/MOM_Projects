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
using System.Text.RegularExpressions;
using DALMomburbia;
using BOMomburbia;

public partial class MOMIndex : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        Response.Expires = -1;
        Response.CacheControl = "no-cache";

        if (!Page.IsPostBack)
        {
            if (Request.Cookies["mE"] != null &&
                Request.Cookies["mD"] != null)
            {
                string momCEmail = MOMHelper.Decrypt(Request.Cookies["mE"].Value);
                string momCPass = MOMHelper.Decrypt(Request.Cookies["mD"].Value);

                momUserName.Text = momCEmail;
                momPassword.Text = momCPass;
            }
        }
    }

    protected void momLogin_Click(object sender, ImageClickEventArgs e)
    {
        MOMDataset momDataset = new MOMDataset();
        MOMDataset.MOM_USRRow myMOM_USRRow = momDataset.MOM_USR.NewMOM_USRRow();
        myMOM_USRRow.EMAIL_ADDR = momUserName.Text;
        myMOM_USRRow.PASSWORD = momPassword.Text;

        try
        {
            MOMUsers checkUser = new MOMUsers();
            checkUser.MOM_USRRow = myMOM_USRRow;
            checkUser.LoginMOM_USRRow(momRemember.Checked, out isSuccess, out appMessage, out sysMessage);
            if (isSuccess)
            {
                Response.Redirect("MOMHome/MOMHome.aspx");
            }
            else
            {
                //Trace.Warn("Unknown user");
                Response.Redirect("MOMLogin/MOMLogin.aspx");
            }
        }
        catch { }
    }
    protected void momAddUser_Click(object sender, EventArgs e)
    {
        try
        {
            if (momFirstName.Text.Length > 0 &&
                momLastName.Text.Length > 0 &&
                momEmail.Text.Length > 0 &&
                momPass.Text.Length > 0 &&
                (momSex.Text == "F" || momSex.Text == "M") &&
                momDisplayName.Text.Length > 0)
            {
                if (momFirstName.Text.Length > 50 || momLastName.Text.Length > 50)
                    throw new MOMException("Too many values in the name");

                if (!MOMHelper.ValidateEmailAddress(momEmail.Text) || momEmail.Text.Length > 255)
                    throw new MOMException("Please fill the correct email address");

                if (momPass.Text.Length < 6 || momPass.Text.Length > 15)
                    throw new MOMException("Password must be 6 - 15 characters.");

                if (!momPass.Text.Equals(momConfirmPass.Text))
                    throw new MOMException("Passwords do not match");

                if (momDisplayName.Text.Length > 25)
                    throw new MOMException("Too many values in the display name");

                if (!momAgreement.Checked)
                    throw new MOMException("You must agree the terms and conditions to register");

                DateTime userDOB;
                string momDOB = momDOBMonth.Text + "/" + momDOBDay.Text + "/" + momDOBYear.Text;
                if (!DateTime.TryParse(momDOB, out userDOB))
                    throw new MOMException("Please fill the correct date of birth");

                MOMDataset momDataset = new MOMDataset();
                MOMDataset.MOM_USRRow myMOM_USRRow = momDataset.MOM_USR.NewMOM_USRRow();

                myMOM_USRRow.FIRST_NAME = momFirstName.Text;
                myMOM_USRRow.LAST_NAME = momLastName.Text;
                myMOM_USRRow.EMAIL_ADDR = momEmail.Text;
                myMOM_USRRow.PASSWORD = momPass.Text;
                myMOM_USRRow.SEX = momSex.Text;
                myMOM_USRRow.DISPLAY_NAME = momDisplayName.Text;
                myMOM_USRRow.DOB = userDOB;
                myMOM_USRRow.NEWLETTER = momEmails.Checked;

                MOMUsers momUser = new MOMUsers();
                momUser.MOM_USRRow = myMOM_USRRow;

                momUser.AddMOM_USRRow(out isSuccess, out appMessage, out sysMessage);

                if (isSuccess)
                {

                    MOMNotifications momNotif = new MOMNotifications();
                    momNotif.EmailRegistrationNotification(myMOM_USRRow);

                    Response.Redirect("MOMNotification/MOMSuccess.aspx");
                }
                else
                {
                    momInfo.Text = appMessage;
                }
            }
            else
            {
                momInfo.Text = "Please fill in all the details...";
            }
        }
        catch (MOMException X)
        {
            momInfo.Text = X.Message;
        }
        catch (Exception X)
        {
        }
    }
}
