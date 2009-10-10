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

public partial class MOMMail_MOMInbox : System.Web.UI.Page
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
            MOMMail momMail = new MOMMail();
            momMail.GetMOM_MAILS(out isSuccess, out appMessage, out sysMessage, "%" + ((MOMDataset.MOM_USRRow)Session["momUser"]).DISPLAY_NAME + "%");

            if (isSuccess)
            {
                if (momMail.MOM_MAILDataTable.Count > 0)
                {
                    momMailInbox.DataSource = momMail.MOM_MAILDataTable.DefaultView;
                    momMailInbox.DataBind();
                    NoMailsTable.Visible = false;
                }
                else
                {
                    NoMailsTable.Visible = true;
                }
            }
            else
            {
                NoMailsTable.Visible = true;
            }
        }
    }

    protected string GetCssClass(bool read)
    {
        return read ? "msgRead" : "msgUnread";
    }
}
