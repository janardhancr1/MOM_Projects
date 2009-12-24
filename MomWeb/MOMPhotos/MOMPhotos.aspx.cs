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

public partial class MOMPhotos_MOMPhotos : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {

    }
    protected void momAlbumSave_Click(object sender, EventArgs e)
    {
        try
        {
            MOMAlbum album = new MOMAlbum();
            MOMDataset.MOM_ALBMRow albumRow = album.MOM_ALBMDataTable.NewMOM_ALBMRow();

            string value;
            int id;

            value = momAlbumTitle.Text.Trim();
            if (value.Length == 0 || value.Length > 50)
                throw new MOMException("Invalid Title");
            albumRow.TITLE = value;

            value = momAlbumDescription.Text.Trim();
            if (value.Length == 0 || value.Length > 50)
                throw new MOMException("Invalid Descriptions");
            albumRow.DESCRIPTION = value;

            value = momAlbumPrivacy.Text.Trim();
            if (value.Length == 0 || value.Length > 50)
                throw new MOMException("Invalid Privacy");
            albumRow.SHARE = value;

            albumRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;

            album.MOM_ALBMRow = albumRow;
            album.AddMOM_ALBMRow(out id, out isSuccess, out appMessage, out sysMessage);

            Response.Redirect("MOMPhotosUpload.aspx?momAlbumId=" + MOMHelper.Encrypt(id.ToString()));
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
    }
}
