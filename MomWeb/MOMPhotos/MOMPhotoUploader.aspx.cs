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
using System.Drawing;
using BOMomburbia;
using DALMomburbia;

public partial class MOMPhotos_MOMPhotoUploader : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {

    }
    protected void momPhotoUpload_Click(object sender, EventArgs e)
    {
        try
        {
            int albumId = int.Parse(MOMHelper.Decrypt(Request.QueryString["momAlbumId"]));
            string fileMap = "map_";

            try
            {
                if (momPhotoUpload_1.HasFile)
                {
                    string fileName = Guid.NewGuid().ToString() + ".jpg";
                    string serverPath = Server.MapPath("~") + "\\MOMUserImages\\" + fileName;
                    string newfilePath = Server.MapPath("~") + "\\MOMUserImages\\" + fileMap + fileName;
                    momPhotoUpload_1.PostedFile.SaveAs(serverPath);

                    Bitmap originalImage = new Bitmap(serverPath);
                    Size newSize = new Size(800, 800);
                    Bitmap newImage = new Bitmap(originalImage, newSize);
                    newImage.Save(newfilePath);

                    MOMAlbum album = new MOMAlbum();
                    MOMDataset.MOM_ALBM_PHTORow photoRow = album.MOM_ALBM_PHTODataTable.NewMOM_ALBM_PHTORow();
                    photoRow.MOM_ALBM_ID = albumId;
                    photoRow.FILE_NAME = "../MOMUserImages/" + fileMap + fileName;
                    photoRow.DESCRIPTION = "Testing";
                    album.MOM_ALBM_PHTORow = photoRow;
                    album.AddMOM_ALBM_PHTORow(out isSuccess, out appMessage, out sysMessage);
                }
            }
            catch { }

            try
            {
                if (momPhotoUpload_2.HasFile)
                {
                    string fileName = Guid.NewGuid().ToString() + ".jpg";
                    string serverPath = Server.MapPath("~") + "\\MOMUserImages\\" + fileName;
                    string newfilePath = Server.MapPath("~") + "\\MOMUserImages\\" + fileMap + fileName;
                    momPhotoUpload_2.PostedFile.SaveAs(serverPath);

                    Bitmap originalImage = new Bitmap(serverPath);
                    Size newSize = new Size(800, 800);
                    Bitmap newImage = new Bitmap(originalImage, newSize);
                    newImage.Save(newfilePath);

                    MOMAlbum album = new MOMAlbum();
                    MOMDataset.MOM_ALBM_PHTORow photoRow = album.MOM_ALBM_PHTODataTable.NewMOM_ALBM_PHTORow();
                    photoRow.MOM_ALBM_ID = albumId;
                    photoRow.FILE_NAME = "../MOMUserImages/" + fileMap + fileName;
                    photoRow.DESCRIPTION = "Testing";
                    album.MOM_ALBM_PHTORow = photoRow;
                    album.AddMOM_ALBM_PHTORow(out isSuccess, out appMessage, out sysMessage);
                }
            }
            catch { }

            try
            {
                if (momPhotoUpload_3.HasFile)
                {
                    string fileName = Guid.NewGuid().ToString() + ".jpg";
                    string serverPath = Server.MapPath("~") + "\\MOMUserImages\\" + fileName;
                    string newfilePath = Server.MapPath("~") + "\\MOMUserImages\\" + fileMap + fileName;
                    momPhotoUpload_3.PostedFile.SaveAs(serverPath);

                    Bitmap originalImage = new Bitmap(serverPath);
                    Size newSize = new Size(800, 800);
                    Bitmap newImage = new Bitmap(originalImage, newSize);
                    newImage.Save(newfilePath);

                    MOMAlbum album = new MOMAlbum();
                    MOMDataset.MOM_ALBM_PHTORow photoRow = album.MOM_ALBM_PHTODataTable.NewMOM_ALBM_PHTORow();
                    photoRow.MOM_ALBM_ID = albumId;
                    photoRow.FILE_NAME = "../MOMUserImages/" + fileMap + fileName;
                    photoRow.DESCRIPTION = "Testing";
                    album.MOM_ALBM_PHTORow = photoRow;
                    album.AddMOM_ALBM_PHTORow(out isSuccess, out appMessage, out sysMessage);
                }
            }
            catch { }

            try
            {
                if (momPhotoUpload_4.HasFile)
                {
                    string fileName = Guid.NewGuid().ToString() + ".jpg";
                    string serverPath = Server.MapPath("~") + "\\MOMUserImages\\" + fileName;
                    string newfilePath = Server.MapPath("~") + "\\MOMUserImages\\" + fileMap + fileName;
                    momPhotoUpload_4.PostedFile.SaveAs(serverPath);

                    Bitmap originalImage = new Bitmap(serverPath);
                    Size newSize = new Size(800, 800);
                    Bitmap newImage = new Bitmap(originalImage, newSize);
                    newImage.Save(newfilePath);

                    MOMAlbum album = new MOMAlbum();
                    MOMDataset.MOM_ALBM_PHTORow photoRow = album.MOM_ALBM_PHTODataTable.NewMOM_ALBM_PHTORow();
                    photoRow.MOM_ALBM_ID = albumId;
                    photoRow.FILE_NAME = "../MOMUserImages/" + fileMap + fileName;
                    photoRow.DESCRIPTION = "Testing";
                    album.MOM_ALBM_PHTORow = photoRow;
                    album.AddMOM_ALBM_PHTORow(out isSuccess, out appMessage, out sysMessage);
                }
            }
            catch { }

            try
            {
                if (momPhotoUpload_5.HasFile)
                {
                    string fileName = Guid.NewGuid().ToString() + ".jpg";
                    string serverPath = Server.MapPath("~") + "\\MOMUserImages\\" + fileName;
                    string newfilePath = Server.MapPath("~") + "\\MOMUserImages\\" + fileMap + fileName;
                    momPhotoUpload_5.PostedFile.SaveAs(serverPath);

                    Bitmap originalImage = new Bitmap(serverPath);
                    Size newSize = new Size(800, 800);
                    Bitmap newImage = new Bitmap(originalImage, newSize);
                    newImage.Save(newfilePath);

                    MOMAlbum album = new MOMAlbum();
                    MOMDataset.MOM_ALBM_PHTORow photoRow = album.MOM_ALBM_PHTODataTable.NewMOM_ALBM_PHTORow();
                    photoRow.MOM_ALBM_ID = albumId;
                    photoRow.FILE_NAME = "../MOMUserImages/" + fileMap + fileName;
                    photoRow.DESCRIPTION = "Testing";
                    album.MOM_ALBM_PHTORow = photoRow;
                    album.AddMOM_ALBM_PHTORow(out isSuccess, out appMessage, out sysMessage);
                }
            }
            catch { }

        }
        catch (Exception X)
        {
        }
    }
}
