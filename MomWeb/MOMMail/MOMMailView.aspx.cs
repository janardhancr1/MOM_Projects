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
using BOMomburbia;
using DALMomburbia;

public partial class MOMMail_MOMMailView : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        bool isSuccess;
        string appMessage;
        string sysMessage;

        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        if (!IsPostBack)
        {
            try
            {
                int momMailID = Int32.Parse(MOMHelper.Decrypt(Request.QueryString["mmailid"]));
                momMailIDHide.Text = Request.QueryString["mmailid"];

                MOMMail momMail = new MOMMail();
                MOMDataset.MOM_MAILRow momMailRow = momMail.MOM_MAILDataTable.NewMOM_MAILRow();
                momMailRow.ID = momMailID;
                momMailRow.MOM_READ = true;
                momMail.MOM_MAILRow = momMailRow;

                momMail.SetMOM_MAIL_MARK_READ(out isSuccess, out appMessage, out sysMessage);

                momMail.GetMOM_MAIL_BY_ID(out isSuccess, out appMessage, out sysMessage);

                if (isSuccess)
                {
                    momMailFrom.Text = MOMHelper.HTMLEncode(momMail.MOM_MAILRow.DISPLAY_NAME);
                    momMailSent.Text = MOMHelper.HTMLEncode(momMail.MOM_MAILRow.TIME.ToString());
                    momMailSubject.Text = MOMHelper.HTMLEncode(momMail.MOM_MAILRow.MOM_SUBJECT);
                    momMailBody.Text = MOMHelper.HTMLEncode(momMail.MOM_MAILRow.MOM_BODY);
                }
            }
            catch
            { }
        }

    }

    protected void momMailReply_Click(object sender, EventArgs e)
    {
        Response.Redirect("MOMCompose.aspx?mmailid=" + momMailIDHide.Text + "&action=reply");
    }

    protected void momMailDelete_Click(object sender, EventArgs e)
    {
        Response.Redirect("MOMMailHome.aspx");
    }
    

}
