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
using System.Drawing;

public partial class MOMFileUpload_MOMFileUpload : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {

    }
    protected void momUploadFileButton_Click(object sender, EventArgs e)
    {
        //Bitmap originalImage;
        //Bitmap newImage;
        try
        {
            if (momFileUploader.HasFile)
            {
                string fileName = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID.ToString() + ".jpg";
                string serverPath = Server.MapPath("~") + "\\MOMUserImages\\" + "temp" + fileName;
                string newfilePath = Server.MapPath("~") + "\\MOMUserImages\\" + fileName;
                momFileUploader.PostedFile.SaveAs(serverPath);

                Bitmap originalImage = new Bitmap(serverPath);
                Size newSize = new Size(100, 100);
                Bitmap newImage = new Bitmap(originalImage, newSize);

                newImage.Save(newfilePath);

                ((MOMDataset.MOM_USRRow)Session["momUser"]).PICTURE = "../MOMUserImages/" + fileName;

                MOMUsers momUser = new MOMUsers();
                momUser.UpdatePicture(out isSuccess, out appMessage, out sysMessage,
                    ((MOMDataset.MOM_USRRow)Session["momUser"]).ID,
                    ((MOMDataset.MOM_USRRow)Session["momUser"]).PICTURE);

                if (Request.QueryString["close"] != null)
                {
                    if (Request.QueryString["close"].Equals("y"))
                    {
                        string script = "<script language=javascript>window.top.close();</script>";
                        if (!Page.IsStartupScriptRegistered("clientScript"))
                        {
                            Page.RegisterStartupScript("clientScript", script);
                        }
                    }
                }
                if (Request.QueryString["from"] != null)
                {
                    if (Request.QueryString["from"].Equals("profile"))
                    {
                        string script = "<script language=javascript>parent.location.reload();</script>";
                        if (!Page.IsStartupScriptRegistered("clientScript"))
                        {
                            Page.RegisterStartupScript("clientScript", script);
                        }
                    }
                }
            }
        }
        catch (Exception X)
        {
            failedInfo.Text = X.Message;
        }
        finally
        {
            //originalImage.Dispose();
            //newImage.Dispose();
        }
    }
}
