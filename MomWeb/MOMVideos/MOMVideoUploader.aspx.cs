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
using System.Data;
using System.Data.SqlClient;
using DALMomburbia;

public partial class MOMVideos_MOMVideoUploader : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {

    }
    protected void momVideoUpload_Click(object sender, EventArgs e)
    {
        try
        {
            if (momVideoFileUpload.HasFile)
            {
                momUploadStatus.Text = "Uploading...";
                string fileName = Guid.NewGuid().ToString() + "_" + momVideoFileUpload.FileName;
                string serverPath = Server.MapPath("~") + "\\MOMUserVideos\\" + fileName;
                momVideoFileUpload.PostedFile.SaveAs(serverPath);
                momUploadStatus.Text = "Uploaded...";
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
    }
}
