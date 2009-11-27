using System;
using System.Web;
using System.Collections;
using System.Web.Services;
using System.Web.Services.Protocols;
using System.Data.SqlClient;
using BOMomburbia;
using DALMomburbia;

/// <summary>
/// Summary description for MOMWebService
/// </summary>
[WebService(Namespace = "http://tempuri.org/")]
[WebServiceBinding(ConformsTo = WsiProfiles.BasicProfile1_1)]
[System.Web.Script.Services.ScriptService()]
public class MOMWebService : System.Web.Services.WebService
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    public MOMWebService()
    {

        //Uncomment the following line if using designed components 
        //InitializeComponent(); 
    }

    [WebMethod(EnableSession=true)]
    public string HelloWorld()
    {
        return "Hello World";
    }

    //[WebMethod(EnableSession = true)]
    //public MOMDataset.MOM_FRG_CMNT_SHAREDDataTable GetMOM_FRG_CMNT_SHAREDDataTable()
    //{
    //    MOMDataset.MOM_FRG_CMNT_SHAREDDataTable MOM_FRG_CMNT_SHAREDDataTable = new MOMDataset.MOM_FRG_CMNT_SHAREDDataTable();
    //    return MOM_FRG_CMNT_SHAREDDataTable;
    //}

    [WebMethod(EnableSession = true)]
    public void DeleteMOM_FRG_CMNTByID(int momFrgId)
    {
        if (Session["momUser"] == null)
            throw new Exception("Your session has expired. Please relogin...");

        MOMFridgeComment momFrgCmnt = new MOMFridgeComment();
        momFrgCmnt.DeleteMOM_FRG_CMNTByID(momFrgId, out isSuccess, out appMessage, out sysMessage);

        if (!isSuccess)
            throw new MOMException(appMessage);
    }

    [WebMethod(EnableSession = true)]
    public void HideMOM_FRGByID(int momFrgId)
    {
        if (Session["momUser"] == null)
            throw new Exception("Your session has expired. Please relogin...");

        MOMFridge momFrg = new MOMFridge();
        momFrg.HideMOM_FRGByID(momFrgId, out isSuccess, out appMessage, out sysMessage);

        if (!isSuccess)
            throw new MOMException(appMessage);
    }

    [WebMethod(EnableSession = true)]
    public void AddFRND_MOM_USR_IDByMOM_USR_ID(string momFriendUserId)
    {
        if (Session["momUser"] == null)
            throw new Exception("Your session has expired. Please relogin...");

        MOMFriend friend = new MOMFriend();
        friend.AddMOM_FRNDByMOM_USR_ID(((MOMDataset.MOM_USRRow)Session["momUser"]).ID,
            long.Parse(MOMHelper.Decrypt(momFriendUserId)), out isSuccess, out appMessage, out sysMessage);

        if (!isSuccess)
            throw new MOMException(appMessage);
    }

    [WebMethod(EnableSession = true)]
    public string AddMOM_FRG_CMNTByMOM_FRG_ID(string momFrgId, string momShareInfo)
    {
        string retValue = string.Empty;
        if (Session["momUser"] == null)
            throw new Exception("Your session has expired. Please relogin...");

        MOMFridgeComment momFrgCmnt = new MOMFridgeComment();
        MOMDataset.MOM_FRG_CMNTRow momFrgCmntRow = momFrgCmnt.MOM_FRG_CMNTDataTable.NewMOM_FRG_CMNTRow();

        momFrgCmntRow.MOM_FRG_ID = int.Parse(momFrgId);
        momFrgCmntRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
        momFrgCmntRow.COMMENTS = momShareInfo;

        momFrgCmnt.MOM_FRG_CMNTRow = momFrgCmntRow;
        momFrgCmnt.AddMOM_FRG_CMNTRow(out isSuccess, out appMessage, out sysMessage);

        if (!isSuccess)
            throw new MOMException(appMessage);

        momShareInfo = MOMHelper.HTMLEncode(MOMHelper.BreakText(momShareInfo, 40));
        retValue = "<div id=\"momFridgeComment" + momFrgCmntRow.ID.ToString()  + "\" style=\"background-color: MistyRose;\"><table width=\"100%\" cellspacing=\"0\" cellpadding=\"3\">";
        retValue += "<tr><td style=\"width: 29px;\" rowspan=\"2\" style=\"font-size: 8pt;\"><img src='" + ((MOMDataset.MOM_USRRow)Session["momUser"]).PICTURE + "' width='25' height='25' //></td><td style=\"font-size: 8pt;\">";
        retValue += "<a href=\"?muI=" + MOMHelper.Encrypt(momFrgCmntRow.MOM_USR_ID.ToString()) + "\" style=\"font-weight: bold;\">" + MOMHelper.HTMLEncode(((MOMDataset.MOM_USRRow)Session["momUser"]).DISPLAY_NAME) + " </a> " + momShareInfo + "</td></tr>";
        retValue += "<tr><td style=\"font-size: 8pt;\">0 minutes ago * <a href=\"javascript:deleteComment('momFridgeComment" + momFrgCmntRow.ID.ToString() + "'," + momFrgCmntRow.ID.ToString() + ")\">delete</a></td></tr></table></div><div style=\"height: 2px; background-color: white;\"></div>";

        return retValue;
    }    
}

