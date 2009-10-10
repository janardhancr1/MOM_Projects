using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Configuration;
using System.Collections;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using BOMomburbia;
using DALMomburbia;

public partial class MOMMail_MOMCompose : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        if (!IsPostBack)
        {
            if (Request.QueryString["mmailid"] != null)
            {
                try
                {
                    int momMailID = Int32.Parse(MOMHelper.Decrypt(Request.QueryString["mmailid"]));

                    MOMMail momMail = new MOMMail();
                    MOMDataset.MOM_MAILRow momMailRow = momMail.MOM_MAILDataTable.NewMOM_MAILRow();
                    momMailRow.ID = momMailID;
                    momMail.MOM_MAILRow = momMailRow;

                    momMail.GetMOM_MAIL_BY_ID(out isSuccess, out appMessage, out sysMessage);

                    if (isSuccess)
                    {
                        momMailTo.Text = MOMHelper.HTMLEncode(momMail.MOM_MAILRow.DISPLAY_NAME);
                        momMailSubject.Text = MOMHelper.HTMLEncode(momMail.MOM_MAILRow.MOM_SUBJECT);
                        momMailBody.Value = MOMHelper.HTMLEncode(momMail.MOM_MAILRow.MOM_BODY);
                    }
                }
                catch
                {
                }
            }
        }
    }

    protected void momMailSend_Click(object sender, EventArgs e)
    {
        List<string> toEmailAddress = new List<string>();
        try
        {
            if (momMailTo.Text.Trim().Length <= 0)
                throw new MOMException("Aleast one To address should be entered.");
            else
            {
                string[] toEmails = momMailTo.Text.Split(',');
                if (toEmails.Length > 25)
                    throw new MOMException("Allowed Max To Address are 25 Only");

                foreach (string toEmail in toEmails)
                {
                    MOMUsers momUsers = new MOMUsers();
                    momUsers.GetUserByName(out isSuccess, out appMessage, out sysMessage, toEmail);
                    if (isSuccess)
                        toEmailAddress.Add(momUsers.MOM_USRRow.EMAIL_ADDR);
                    else
                        throw new MOMException(toEmail + " - " + appMessage);
                }
            }

            if (momMailSubject.Text.Trim().Length < 2 || momMailSubject.Text.Trim().Length > 100)
                throw new MOMException("Subject can have minimum 2 and maximum of 100 characters");

            if (momMailBody.Value.Trim().Length == 0)
                throw new MOMException("Please enter the Message");

            MOMMail momMail = new MOMMail();
            MOMDataset.MOM_MAILRow momMailRow = momMail.MOM_MAILDataTable.NewMOM_MAILRow();

            momMailRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
            momMailRow.MOM_TO_EMAIL = momMailTo.Text;
            momMailRow.MOM_SUBJECT = momMailSubject.Text;
            momMailRow.MOM_BODY = momMailBody.Value;

            momMail.MOM_MAILRow = momMailRow;
            momMail.AddMOM_MAILRow(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                MOMNotifications momNotif = new MOMNotifications();
                momNotif.SendMOMMails(toEmailAddress, momMailSubject.Text, momMailBody.Value, (MOMDataset.MOM_USRRow)Session["momUser"]);

                momPopup.Show("Mail Send Successfully.");
                RedirectToMOMRecipes();
            }
            else
            {
                momPopup.Show(appMessage);
            }


        }
        catch (MOMException X)
        {
            momPopup.Show(X.Message);
        }
        catch (SqlException X)
        {
            momPopup.Show(X.Message);
        }
        catch (Exception X)
        {
            momPopup.Show(X.Message);
        }
    }

    protected void momMailCancel_Click(object sender, EventArgs e)
    {

    }

    private void RedirectToMOMRecipes()
    {
        Response.Redirect("MOMMailHome.aspx");
    }
}
