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
using System.Data.SqlClient;

public partial class MOMShareLink_MOMShareLink : System.Web.UI.Page
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
            try
            {
                momUserName.Text = MOMHelper.HTMLEncode(((MOMDataset.MOM_USRRow)Session["momUser"]).FULL_NAME);

                MOMFridge momFrg = new MOMFridge();
                MOMDataset.MOM_FRGRow frgRow = momFrg.MOM_FRGDataTable.NewMOM_FRGRow();
                frgRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
                frgRow.TYPE = "S";

                momFrg.MOM_FRGRow = frgRow;
                momFrg.GetMOM_FRGDataTableByMOM_USR_ID(out isSuccess, out appMessage, out sysMessage);

                if (isSuccess)
                {
                    Session.Add("momFridge", momFrg.MOM_FRG_SHAREDDataTable);
                    Session.Add("momFridgeComments", momFrg.MOM_FRG_CMNT_SHAREDDataTable);
                }
                else
                {
                    //todo show popup
                }
            }
            catch (MOMException X)
            {
            }
            catch (SqlException X)
            {
            }
            catch (Exception X)
            {
            }
            finally
            {
                BindMOM_FRG_SHAREDData();
            }
        }
    }
    private void BindMOM_FRG_SHAREDData()
    {
        momFridgeShared.DataSource = ((MOMDataset.MOM_FRG_SHAREDDataTable)Session["momFridge"]).DefaultView;
        momFridgeShared.DataBind();
    }

    protected void momPublish_Click(object sender, EventArgs e)
    {
        try
        {
            MOMDataset.MOM_FRG_SHAREDDataTable momFrgShared = (MOMDataset.MOM_FRG_SHAREDDataTable)Session["momFridge"];
            MOMDataset.MOM_FRG_SHAREDRow momFrgSharedRow = momFrgShared.NewMOM_FRG_SHAREDRow();

            MOMFridge momFrg = new MOMFridge();
            MOMDataset.MOM_FRGRow momFrgRow = momFrg.MOM_FRGDataTable.NewMOM_FRGRow();

            MOMDataset.MOM_USRRow momUserRow = (MOMDataset.MOM_USRRow)Session["momUser"];

            momFrgRow.MOM_USR_ID = momUserRow.ID;
            momFrgRow.SHARE = momShare.Text;
            momFrgRow.TYPE = "D";

            if (momShareLinkStatus.Value.Equals("T"))
            {
                momFrgRow.TYPE = "S";

                if (momShareLink.Text.Trim().Length == 0)
                    throw new MOMException("No URL was provided");

                momFrgRow.TYPE_SHARE = Server.UrlEncode(momShareLink.Text);
            }
            momFrg.MOM_FRGRow = momFrgRow;
            momFrg.AddMOM_FRGRow(out isSuccess, out appMessage, out sysMessage);

            if (!isSuccess)
                throw new MOMException(appMessage);

            momFrgSharedRow.DISPLAY_NAME = momUserRow.DISPLAY_NAME;
            momFrgSharedRow.PICTURE = momUserRow.PICTURE;
            momFrgSharedRow.SHARE = momShare.Text;
            momFrgSharedRow.MOM_USR_ID = momUserRow.ID;
            momFrgSharedRow.ID = momFrg.MOM_FRGRow.ID;

            if (!momFrg.MOM_FRGRow.IsTYPENull())
                momFrgSharedRow.TYPE = momFrg.MOM_FRGRow.TYPE;

            if (!momFrg.MOM_FRGRow.IsTYPE_SHARENull())
                momFrgSharedRow.TYPE_SHARE = momFrg.MOM_FRGRow.TYPE_SHARE;

            //momFrgSharedRow.TIME = momFrg.MOM_FRGRow.TIME;
            momFrgSharedRow.TIME = "0  minutes ago";
            momFrgShared.Rows.InsertAt((DataRow)momFrgSharedRow, 0);

            Session["momFridge"] = momFrgShared;
            momShare.Text = string.Empty;

            //momPopupExtender.Show(appMessage);
        }
        catch (MOMException X)
        {
            momPopupExtender.Show(X.Message);
        }
        catch (SqlException X)
        {
            momPopupExtender.Show(X.Message);
        }
        catch (Exception X)
        {
            momPopupExtender.Show(X.Message);
        }
        finally
        {
            momShareLink.Text = string.Empty;
            momShareLinkStatus.Value = "F";
            BindMOM_FRG_SHAREDData();
        }
    }

    protected void momFridgeShared_ItemDataBound(object sender, RepeaterItemEventArgs e)
    {
        try
        {
            RepeaterItem rptItem = e.Item;
            DataRowView dataRow = (DataRowView)rptItem.DataItem;
            MOMDataset.MOM_FRG_SHAREDRow momFrgSharedRow = (MOMDataset.MOM_FRG_SHAREDRow)dataRow.Row;

            MOMDataset.MOM_FRG_CMNT_SHAREDDataTable momFridgeComment = (MOMDataset.MOM_FRG_CMNT_SHAREDDataTable)Session["momFridgeComments"];
            MOMDataset.MOM_FRG_CMNT_SHAREDRow[] momFridgeCommentRow = (MOMDataset.MOM_FRG_CMNT_SHAREDRow[])momFridgeComment.Select("MOM_FRG_ID = " + momFrgSharedRow.ID.ToString(), "ID ASC");

            MOMFridge momFrgComment = new MOMFridge();
            //momFrgComment.MOM_FRG_CMNT_SHAREDDataTable.AddMOM_FRG_CMNT_SHAREDRow(momFridgeCommentRow);

            foreach (MOMDataset.MOM_FRG_CMNT_SHAREDRow myRow in momFridgeCommentRow)
            {
                momFrgComment.MOM_FRG_CMNT_SHAREDDataTable.ImportRow(myRow);
            }

            Repeater r = (Repeater)e.Item.FindControl("momFridgeCommentsRpt");

            if (r != null)
            {
                r.DataSource = momFrgComment.MOM_FRG_CMNT_SHAREDDataTable.DefaultView;
                r.DataBind();
            }
        }
        catch { }
    }
}
