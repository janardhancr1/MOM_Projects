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

public partial class MOMFeedShare_MOMFeedShare : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        Response.BufferOutput = true;
        try
        {
            if (!IsPostBack)
            {
                momUserName.Text = MOMHelper.HTMLEncode(((MOMDataset.MOM_USRRow)Session["momUser"]).FULL_NAME);

                MOMFridge momFrg = new MOMFridge();
                MOMDataset.MOM_FRGRow frgRow = momFrg.MOM_FRGDataTable.NewMOM_FRGRow();
                frgRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;

                momFrg.MOM_FRGRow = frgRow;
                momFrg.GetMOM_FRGDataTableByMOM_USR_ID(out isSuccess, out appMessage, out sysMessage);

                if (isSuccess)
                {
                    Session.Add("momFridge", momFrg.MOM_FRG_SHAREDDataTable);
                    BindMOM_FRG_SHAREDData();
                }
                else
                {
                    //todo show popup
                }
            }
        }
        catch (Exception X)
        {
            //todo show popup
        }
    }

    private void BindMOM_FRG_SHAREDData()
    {
        momFridgeShared.DataSource = ((MOMDataset.MOM_FRG_SHAREDDataTable)Session["momFridge"]).DefaultView;
        momFridgeShared.DataBind();
    }

    protected void momPublish_Click(object sender, EventArgs e)
    {
        MOMDataset.MOM_FRG_SHAREDDataTable momFrgShared = (MOMDataset.MOM_FRG_SHAREDDataTable)Session["momFridge"];
        MOMDataset.MOM_FRG_SHAREDRow momFrgRow = momFrgShared.NewMOM_FRG_SHAREDRow();

        MOMDataset.MOM_USRRow momUserRow = (MOMDataset.MOM_USRRow)Session["momUser"];
        momFrgRow.DISPLAY_NAME = momUserRow.DISPLAY_NAME;
        momFrgRow.PICTURE = momUserRow.PICTURE;
        momFrgRow.SHARE = momShare.Text;
        momFrgRow.MOM_USR_ID = momUserRow.ID;
        momFrgRow.ID = -1;
        //momFrgShared.adda(0, momFrgRow);
        //momFrgShared.AddMOM_FRG_SHAREDRow(momFrgRow);

        Session["momFridge"] = momFrgShared;
        momShare.Text = string.Empty;
        BindMOM_FRG_SHAREDData();
    }
}
