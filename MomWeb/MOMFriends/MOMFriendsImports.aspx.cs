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
using DALMomburbia;
using BOMomburbia;
using System.Net;

public partial class MOMFriends_MOMFriendsImports : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");
    }
    protected void momFindFriends_Click(object sender, EventArgs e)
    {
        //MailContactList list = null;

        //if (momEmailAddress.Text.ToLower().EndsWith("gmail.com"))
        //{
        //    GmailExtract extractor = new GmailExtract();
        //    NetworkCredential ntCredentials = new NetworkCredential(momEmailAddress.Text, momEmailPassword.Text);
        //    bool result = extractor.Extract(ntCredentials, out list);
        //}
        ////else if (momEmailAddress.Text.ToLower().EndsWith("yahoo.com"))
        ////{
        ////    YahooExtract extractor = new YahooExtract();
        ////    NetworkCredential ntCredentials = new NetworkCredential(momEmailAddress.Text, momEmailPassword.Text);
        ////    bool result = extractor.Extract(ntCredentials, out list);
        ////}

        //if (list != null)
        //{
        //    MOMDataset.MOM_IMPT_EMAILDataTable momEmailDataTable = new MOMDataset.MOM_IMPT_EMAILDataTable();
            
        //    if(list.Count > 1)
        //        list.RemoveAt(0);
        //    foreach (MailContact myContacts in list)
        //    {
        //        if (myContacts.Email.Length > 5)
        //        {
        //            MOMDataset.MOM_IMPT_EMAILRow momEmailRow = momEmailDataTable.NewMOM_IMPT_EMAILRow();
        //            momEmailRow.NAME = myContacts.Name;
        //            momEmailRow.EMAIL = myContacts.Email;

        //            momEmailDataTable.AddMOM_IMPT_EMAILRow(momEmailRow);
        //        }
        //    }

        //    momEmailContactsRepeater.DataSource = momEmailDataTable.DefaultView;
        //    momEmailContactsRepeater.DataBind();

        //    if (momEmailDataTable.Rows.Count > 1)
        //        momEmailExtractPanel.Visible = false;
        //}
    }
}
