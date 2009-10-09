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

public partial class MOMMail_MOMMailHome : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        //if(Request.QueryString["mIn"] != null && Request.QueryString["mIn"].ToString() == "cm")
        //    momTranscationFrame.Attributes["src"] = "MOMCompose.aspx";
    }
}
