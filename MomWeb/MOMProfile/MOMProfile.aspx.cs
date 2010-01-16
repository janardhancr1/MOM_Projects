using System;
using System.Data;
using System.Data.SqlClient;
using System.Configuration;
using System.Collections;
using System.Drawing;
using System.IO;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using DALMomburbia;
using BOMomburbia;

public partial class MOMProfile_MOMProfile : System.Web.UI.Page
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
            momPrivacyName.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_NAME_SEARCHABLE));
            momPrivacyName.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_NAME_NOT_SEARCHABLE));

            momPrivacyDOB.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_ALL));
            momPrivacyDOB.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_FRIENDS));
            momPrivacyDOB.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_PRIVATE));

            momPrivacyInterest.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_ALL));
            momPrivacyInterest.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_FRIENDS));
            momPrivacyInterest.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_PRIVATE));

            momPrivacyEdu.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_ALL));
            momPrivacyEdu.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_FRIENDS));
            momPrivacyEdu.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_PRIVATE));

            momPrivacyKids.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_ALL));
            momPrivacyKids.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_FRIENDS));
            momPrivacyKids.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_PRIVATE));

            momPrivacyKidsDOB.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_ALL));
            momPrivacyKidsDOB.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_FRIENDS));
            momPrivacyKidsDOB.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_PRIVATE));

            momPrivacyKidsPhoto.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_ALL));
            momPrivacyKidsPhoto.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_FRIENDS));
            momPrivacyKidsPhoto.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_PRIVATE));

            momPrivacyKidsAbout.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_ALL));
            momPrivacyKidsAbout.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_FRIENDS));
            momPrivacyKidsAbout.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_PRIVATE));

            momPrivacyKidsInterest.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_ALL));
            momPrivacyKidsInterest.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_FRIENDS));
            momPrivacyKidsInterest.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_PRIVATE));

            momPrivacyLogin.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_ALL));
            momPrivacyLogin.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_FRIENDS));
            momPrivacyLogin.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_TO_PRIVATE));

            momPrivacyProfile.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_PROFILE_TO_ALL));
            momPrivacyProfile.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_PROFILE_TO_FRIENDS));
            momPrivacyProfile.Items.Add(new ListItem(MOMHelper.MOM_PRIVACY_PROFILE_TO_MEMBERS));

            if (Request.QueryString["q"] != null)
            {
                if (Request.QueryString["q"].ToUpper() == "EDIT")
                {
                    HtmlAnchor chgMenu = new HtmlAnchor();
                    chgMenu.ID = "TestMenuLink";
                    chgMenu.Name = "1";
                    ChangeMenu(chgMenu, e);
                }
            }
        }
    }

    protected void ChangeMenu(object sender, EventArgs e)
    {
        string s = ((HtmlAnchor)sender).Name;
        MultiView1.ActiveViewIndex = Int32.Parse(s);
        if (s.Equals("1"))
        {
            if (Request.QueryString["q"] != null)
            {
                if (Request.QueryString["q"].ToUpper() == "EDIT")
                {
                    MultiView1.ActiveViewIndex = 2;
                }
            }
        }

        switch (MultiView1.ActiveViewIndex)
        {
            case 1:
                MOMUsers momUsers = new MOMUsers();
                momUsers.GetUserByName(out isSuccess, out appMessage, out sysMessage, ((MOMDataset.MOM_USRRow)Session["momUser"]).DISPLAY_NAME);
                if (isSuccess)
                {
                    momFirstName.Text = momUsers.MOM_USRRow.FIRST_NAME;
                    //momFirstNameLbl.Text = momUsers.MOM_USRRow.FIRST_NAME;
                    momLastName.Text = momUsers.MOM_USRRow.LAST_NAME;
                    momEmail.Text = momUsers.MOM_USRRow.EMAIL_ADDR;
                    momZipCode.Text = momUsers.MOM_USRRow.ZIP;
                    momLocation.Text = momUsers.MOM_USRRow.LOCATION;
                    momCountry.SelectedValue = momUsers.MOM_USRRow.COUNTRY;
                    momDisplayName.Text = momUsers.MOM_USRRow.DISPLAY_NAME;
                    momJoinedDate.Text = momUsers.MOM_USRRow.TIME.ToLongDateString() + " " + momUsers.MOM_USRRow.TIME.ToLongTimeString();

                    if (momUsers.MOM_USRRow.INTEREST != null)
                        momUserInterests.Value = momUsers.MOM_USRRow.INTEREST;
                }

                ShowKids();
                ShowSchools();
                ShowFavorites();
                ShowPrivacy();
                ShowBlockedUsers();

                break;
            case 0:
                break;
        }
    }

    protected void momFridgeShared_ItemDataBound(object sender, RepeaterItemEventArgs e)
    {
    }

    protected void momPublish_Click(object sender, EventArgs e)
    {
    }

    protected void DetailsSave_Click(object sender, EventArgs e)
    {
        try
        {
            MOMUsers momUsers = new MOMUsers();
            MOMDataset momDataset = new MOMDataset();
            MOMDataset.MOM_USRRow momUserRow = momDataset.MOM_USR.NewMOM_USRRow();

            momUserRow.ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
            momUserRow.COUNTRY = momCountry.SelectedValue;
            momUserRow.ZIP = momZipCode.Text;
            momUserRow.LOCATION = momLocation.Text;


            momUsers.MOM_USRRow = momUserRow;
            momUsers.UpdateDetails(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                momPopup.Show("Saved.");
            }
            else
            {
                momPopup.Show(appMessage);
            }
        }
        catch (MOMException X)
        {
            momPopup.Show(X.Message);
        }
        catch (SqlException X)
        {
            momPopup.Show(X.Message);
        }
        catch (Exception X)
        {
            momPopup.Show(X.Message);
        }
    }

    protected void momUpload_Click(object sender, EventArgs e)
    {
        //try
        //{
        //    if (PhotoUpload.HasFile)
        //    {
        //        string fileName = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID.ToString() + ".jpg";
        //        string serverPath = Server.MapPath("~") + "\\MOMUserImages\\" + "temp" + fileName;
        //        string newfilePath = Server.MapPath("~") + "\\MOMUserImages\\" + fileName;
        //        PhotoUpload.PostedFile.SaveAs(serverPath);

        //        Bitmap originalImage = new Bitmap(serverPath);
        //        Size newSize = new Size(100, 100);
        //        Bitmap newImage = new Bitmap(originalImage, newSize);

        //        newImage.Save(newfilePath);

        //        ((MOMDataset.MOM_USRRow)Session["momUser"]).PICTURE = "../MOMUserImages/" + fileName;

        //        MOMUsers momUser = new MOMUsers();
        //        momUser.UpdatePicture(out isSuccess, out appMessage, out sysMessage,
        //            ((MOMDataset.MOM_USRRow)Session["momUser"]).ID,
        //            ((MOMDataset.MOM_USRRow)Session["momUser"]).PICTURE);

        //    }
        //}
        //catch (Exception X)
        //{
        //    momPopup.Show(X.Message);
        //}
    }

    protected void selectAvatar(object sender, EventArgs e)
    {
        string s = ((HtmlAnchor)sender).Name;
        if (s.Trim().Length > 0)
        {
            string newfile = Server.MapPath("~") + "/images/profile/avatar_" + s + "_md.jpg";
            setPofileImage(newfile);
        }
    }

    private void setPofileImage(string newFilename)
    {
        string fileName = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID.ToString() + ".jpg";
        string serverPath = Server.MapPath("~") + "\\MOMUserImages\\" + "temp" + fileName;
        string newfilePath = Server.MapPath("~") + "\\MOMUserImages\\" + fileName;
        File.Copy(newFilename, serverPath, true);

        Bitmap originalImage = new Bitmap(serverPath);
        Size newSize = new Size(100, 100);
        Bitmap newImage = new Bitmap(originalImage, newSize);

        newImage.Save(newfilePath);

        ((MOMDataset.MOM_USRRow)Session["momUser"]).PICTURE = "../MOMUserImages/" + fileName;

        MOMUsers momUser = new MOMUsers();
        momUser.UpdatePicture(out isSuccess, out appMessage, out sysMessage,
            ((MOMDataset.MOM_USRRow)Session["momUser"]).ID,
            ((MOMDataset.MOM_USRRow)Session["momUser"]).PICTURE);
        Response.Redirect("~/MOMProfile/MOMProfile.aspx?q=edit");
    }

    protected void Kids_Load(object sender, EventArgs e)
    {
        //string s = momProfileAccordion.SelectedIndex.ToString();
    }

    protected void KidSave_Click(object sender, EventArgs e)
    {
        try
        {
            if (momKidFirstName.Text.Trim().Length < 2 || momKidFirstName.Text.Trim().Length > 50)
                throw new MOMException("First Name can have minimum 2 and maximum 100 characters");

            if (momKidGender.SelectedValue.Length < 2)
                throw new MOMException("Gender should be selected");

            if (momKidMonth.SelectedValue.Trim().Length == 0 || momKidDay.SelectedValue.Trim().Length == 0 || momKidYear.SelectedValue.Trim().Length == 0)
                throw new MOMException("Please select valid DOB");

            MOMKids momKids = new MOMKids();
            MOMDataset.MOM_KIDSRow momKidsRow = momKids.MOM_KIDSDataTable.NewMOM_KIDSRow();
            momKidsRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
            momKidsRow.KID_FIRST_NAME = momKidFirstName.Text;
            momKidsRow.KID_GENDER = momKidGender.SelectedValue;
            momKidsRow.KID_DOB = Convert.ToDateTime(momKidMonth.SelectedValue + "/" + momKidDay.SelectedValue + "/" + momKidYear.SelectedValue);
            momKidsRow.KID_PHOTO = momKidPhoto.Text;
            momKidsRow.KID_ABOUT = momKidAbout.Value;

            momKids.MOM_KIDSRow = momKidsRow;
            momKids.AddMOM_KidsRow(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                ShowKids();
            }
            else
            {
                momPopup.Show(appMessage);
            }
        }
        catch (MOMException X)
        {
            momPopup.Show(X.Message);
        }
        catch (SqlException X)
        {
            momPopup.Show(X.Message);
        }
        catch (Exception X)
        {
            momPopup.Show(X.Message);
        }
    }

    protected void SchSave_Click(object sender, EventArgs e)
    {
        try
        {
            if (momSchName.Text.Trim().Length < 2 || momSchName.Text.Trim().Length > 50)
                throw new MOMException("School Name can have minimum 2 and maximum 100 characters");

            if (momSchType.SelectedValue.Length < 2)
                throw new MOMException("School type should be selected");

            MOMUserEducation momSchools = new MOMUserEducation();
            MOMDataset.MOM_USR_EDURow momSchoolRow = momSchools.MOM_USR_EDUDataTable.NewMOM_USR_EDURow();
            momSchoolRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
            momSchoolRow.MOM_SCH_NAME = momSchName.Text;
            momSchoolRow.MOM_SCH_TYPE = momSchType.SelectedValue;
            if (momSchSt.SelectedValue.Trim().Length > 0)
                momSchoolRow.MOM_SCH_ST = Convert.ToInt32(momSchSt.SelectedValue);
            if (momSchEd.SelectedValue.Trim().Length > 0)
                momSchoolRow.MOM_SCH_ED = Convert.ToInt32(momSchEd.SelectedValue);

            momSchools.MOM_USR_EDURow = momSchoolRow;
            momSchools.AddMOM_USR_EDURow(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                ShowSchools();
            }
            else
            {
                momPopup.Show(appMessage);
            }
        }
        catch (MOMException X)
        {
            momPopup.Show(X.Message);
        }
        catch (SqlException X)
        {
            momPopup.Show(X.Message);
        }
        catch (Exception X)
        {
            momPopup.Show(X.Message);
        }
    }

    protected void IntSave_Click(object sender, EventArgs e)
    {
        MOMUsers user = new MOMUsers();
        try
        {
            user.UpdateInterest(out isSuccess, out appMessage, out sysMessage, momUserInterests.Value, ((MOMDataset.MOM_USRRow)Session["momUser"]).ID);

            if (isSuccess)
            {
                momPopup.Show("Saved.");
            }
            else
            {
                momPopup.Show(appMessage);
            }
        }
        catch (MOMException X)
        {
            momPopup.Show(X.Message);
        }
        catch (SqlException X)
        {
            momPopup.Show(X.Message);
        }
        catch (Exception X)
        {
            momPopup.Show(X.Message);
        }
    }

    protected void FavSave_Click(object sender, EventArgs e)
    {
        try
        {
            MOMUserFavorites userFavorites = new MOMUserFavorites();
            MOMDataset.MOM_USR_FAVRow usrFavRow = userFavorites.MOM_USR_FAVDataTable.NewMOM_USR_FAVRow();
            usrFavRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;

            if (momUsrFavCeleb.Value.Trim().Length > 0) usrFavRow.MOM_FAV_CELEB = momUsrFavCeleb.Value;
            if (momUsrFavMov.Value.Trim().Length > 0) usrFavRow.MOM_FAV_MOV = momUsrFavMov.Value;
            if (momUsrFavTv.Value.Trim().Length > 0) usrFavRow.MOM_FAV_TV = momUsrFavTv.Value;
            if (momUsrFavBook.Value.Trim().Length > 0) usrFavRow.MOM_FAV_BOOKS = momUsrFavBook.Value;
            if (momUsrFavMusic.Value.Trim().Length > 0) usrFavRow.MOM_FAV_MUSIC = momUsrFavMusic.Value;

            userFavorites.MOM_USR_FAVRow = usrFavRow;
            userFavorites.UpdateMOM_UserFavRow(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                momPopup.Show("Saved.");
            }
            else
            {
                momPopup.Show(appMessage);
            }
        }
        catch (MOMException X)
        {
            momPopup.Show(X.Message);
        }
        catch (SqlException X)
        {
            momPopup.Show(X.Message);
        }
        catch (Exception X)
        {
            momPopup.Show(X.Message);
        }
    }

    protected void PrivacySave_Click(object sender, EventArgs e)
    {
        try
        {
            MOMUserPrivacy momUsrPrivacy = new MOMUserPrivacy();
            MOMDataset.MOM_USR_PRIVACYRow usrPrivacyRow = momUsrPrivacy.MOM_USR_PRIVACYDataTable.NewMOM_USR_PRIVACYRow();
            usrPrivacyRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;

            if (momPrivacyName.SelectedValue.Trim().Length > 0) usrPrivacyRow.MOM_SHW_NAME = momPrivacyName.SelectedValue;
            if (momPrivacyDOB.SelectedValue.Trim().Length > 0) usrPrivacyRow.MOM_SHW_DOB = momPrivacyDOB.SelectedValue;
            if (momPrivacyInterest.SelectedValue.Trim().Length > 0) usrPrivacyRow.MOM_SHW_INTRST = momPrivacyInterest.SelectedValue;
            if (momPrivacyEdu.SelectedValue.Trim().Length > 0) usrPrivacyRow.MOM_SHW_EDU = momPrivacyEdu.SelectedValue;
            if (momPrivacyKids.SelectedValue.Trim().Length > 0) usrPrivacyRow.MOM_SHW_KIDS = momPrivacyKids.SelectedValue;
            if (momPrivacyKidsDOB.SelectedValue.Trim().Length > 0) usrPrivacyRow.MOM_SHW_KIDS_DOB = momPrivacyKidsDOB.SelectedValue;
            if (momPrivacyKidsPhoto.SelectedValue.Trim().Length > 0) usrPrivacyRow.MOM_SHW_KIDS_PHOTO = momPrivacyKidsPhoto.SelectedValue;
            if (momPrivacyKidsAbout.SelectedValue.Trim().Length > 0) usrPrivacyRow.MOM_SHW_KIDS_ABOUT = momPrivacyKidsAbout.SelectedValue;
            if (momPrivacyKidsInterest.SelectedValue.Trim().Length > 0) usrPrivacyRow.MOM_SHW_KIDS_CHAN = momPrivacyKidsInterest.SelectedValue;
            if (momPrivacyLogin.SelectedValue.Trim().Length > 0) usrPrivacyRow.MOM_SHW_ACT = momPrivacyLogin.SelectedValue;
            if (momPrivacyProfile.SelectedValue.Trim().Length > 0) usrPrivacyRow.MOM_SHW_TO = momPrivacyProfile.SelectedValue;

            momUsrPrivacy.MOM_USR_PRIVACYRow = usrPrivacyRow;
            momUsrPrivacy.UpdateMOM_UserPrivacyRow(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                momPopup.Show("Saved.");
            }
            else
            {
                momPopup.Show(appMessage);
            }
        }
        catch (MOMException X)
        {
            momPopup.Show(X.Message);
        }
        catch (SqlException X)
        {
            momPopup.Show(X.Message);
        }
        catch (Exception X)
        {
            momPopup.Show(X.Message);
        }
    }

    protected void Block_User_Click(object sender, EventArgs e)
    {
        try
        {
            if (BlockUserName.Text.Trim().Length < 3 || BlockUserName.Text.Trim().Length > 50)
                throw new MOMException("User Display Name can have minimum 3 and maximum 100 characters");

            MOMUsers momUsers = new MOMUsers();
            momUsers.GetUserByName(out isSuccess, out appMessage, out sysMessage, BlockUserName.Text);
            if (isSuccess)
            {
                MOMBlockedUsers momBlockedUsers = new MOMBlockedUsers();
                MOMDataset.MOM_BLK_USRSRow blockUserRow = momBlockedUsers.MOM_BLK_USRSDataTable.NewMOM_BLK_USRSRow();
                blockUserRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
                blockUserRow.MOM_BLK_USR_ID = momUsers.MOM_USRRow.ID;

                momBlockedUsers.MOM_BLK_USRSRow = blockUserRow;
                momBlockedUsers.AddMOM_BlockedUserRow(out isSuccess, out appMessage, out sysMessage);

                if (isSuccess)
                {
                    momPopup.Show("Saved.");
                    BlockUserName.Text = "";
                    ShowBlockedUsers();
                }
                else
                {
                    momPopup.Show(appMessage);
                }
            }
            else
            {
                throw new MOMException(BlockUserName.Text + " not found.");
            }
        }
        catch (MOMException X)
        {
            momPopup.Show(X.Message);
        }
        catch (SqlException X)
        {
            momPopup.Show(X.Message);
        }
        catch (Exception X)
        {
            momPopup.Show(X.Message);
        }
    }

    private void ShowKids()
    {
        MOMKids momKids = new MOMKids();
        MOMDataset.MOM_KIDSRow momKidsRow = momKids.MOM_KIDSDataTable.NewMOM_KIDSRow();
        momKidsRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;

        momKidsTable.Rows.Clear();

        HtmlTableRow row = null;
        HtmlTableCell cell = null;

        row = new HtmlTableRow();
        row.BgColor = "Gray";

        cell = new HtmlTableCell();
        cell.Width = "40%";
        cell.InnerHtml = "Name";
        row.Cells.Add(cell);

        cell = new HtmlTableCell();
        cell.Width = "20%";
        cell.InnerHtml = "BirthDay";
        row.Cells.Add(cell);

        cell = new HtmlTableCell();
        cell.Width = "20%";
        cell.InnerHtml = "Gender";
        row.Cells.Add(cell);

        cell = new HtmlTableCell();
        cell.Width = "20%";
        cell.InnerHtml = "Edit/Delete";
        row.Cells.Add(cell);

        momKidsTable.Rows.Add(row);

        momKids.MOM_KIDSRow = momKidsRow;
        momKids.GetMOM_KidsBy_UsrID(out isSuccess, out appMessage, out sysMessage);
        if (isSuccess)
        {
            int i = 1;
            foreach (MOMDataset.MOM_KIDSRow kidsRow in momKids.MOM_KIDSDataTable)
            {
                row = new HtmlTableRow();

                cell = new HtmlTableCell();
                cell.InnerHtml = kidsRow.KID_FIRST_NAME;
                row.Cells.Add(cell);

                cell = new HtmlTableCell();
                cell.InnerHtml = kidsRow.KID_DOB.ToShortDateString();
                row.Cells.Add(cell);

                cell = new HtmlTableCell();
                cell.InnerHtml = kidsRow.KID_GENDER;
                row.Cells.Add(cell);

                cell = new HtmlTableCell();
                cell.InnerHtml = "<img src='../images/profile/Icon_Edit.gif' onclick='javascript:showKid(" + i + ",\"" + momKidsTable.ClientID + "\");'>";
                row.Cells.Add(cell);

                i++;
                momKidsTable.Rows.Add(row);
            }
        }
    }

    private void ShowSchools()
    {
        MOMUserEducation momSchools = new MOMUserEducation();
        MOMDataset.MOM_USR_EDURow momSchoolRow = momSchools.MOM_USR_EDUDataTable.NewMOM_USR_EDURow();
        momSchoolRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;

        momEduTable.Rows.Clear();

        HtmlTableRow row = null;
        HtmlTableCell cell = null;

        row = new HtmlTableRow();
        row.BgColor = "Gray";

        cell = new HtmlTableCell();
        cell.Width = "40%";
        cell.InnerHtml = "Name";
        row.Cells.Add(cell);

        cell = new HtmlTableCell();
        cell.Width = "15%";
        cell.InnerHtml = "Type";
        row.Cells.Add(cell);

        cell = new HtmlTableCell();
        cell.Width = "15%";
        cell.InnerHtml = "Start";
        row.Cells.Add(cell);

        cell = new HtmlTableCell();
        cell.Width = "15%";
        cell.InnerHtml = "End";
        row.Cells.Add(cell);

        cell = new HtmlTableCell();
        cell.Width = "15%";
        cell.InnerHtml = "Edit/Delete";
        row.Cells.Add(cell);

        momEduTable.Rows.Add(row);

        momSchools.MOM_USR_EDURow = momSchoolRow;
        momSchools.GetMOM_Usr_EDU(out isSuccess, out appMessage, out sysMessage);
        if (isSuccess)
        {
            foreach (MOMDataset.MOM_USR_EDURow school in momSchools.MOM_USR_EDUDataTable)
            {
                row = new HtmlTableRow();

                cell = new HtmlTableCell();
                cell.InnerHtml = school.MOM_SCH_NAME;
                row.Cells.Add(cell);

                cell = new HtmlTableCell();
                cell.InnerHtml = school.MOM_SCH_TYPE;
                row.Cells.Add(cell);

                cell = new HtmlTableCell();
                cell.InnerHtml = school.MOM_SCH_ST.ToString();
                row.Cells.Add(cell);

                cell = new HtmlTableCell();
                cell.InnerHtml = school.MOM_SCH_ED.ToString();
                row.Cells.Add(cell);

                cell = new HtmlTableCell();
                cell.InnerHtml = "&nbsp;";
                row.Cells.Add(cell);

                momEduTable.Rows.Add(row);
            }
        }
    }

    private void ShowFavorites()
    {
        MOMUserFavorites momUsrFavorites = new MOMUserFavorites();
        MOMDataset.MOM_USR_FAVRow usrFavRow = momUsrFavorites.MOM_USR_FAVDataTable.NewMOM_USR_FAVRow();
        usrFavRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
        momUsrFavorites.MOM_USR_FAVRow = usrFavRow;

        momUsrFavorites.GetMOM_User_Favorites(out isSuccess, out appMessage, out sysMessage);
        if (isSuccess)
        {
            if (momUsrFavorites.MOM_USR_FAVRow.MOM_FAV_CELEB != null)
                momUsrFavCeleb.Value = momUsrFavorites.MOM_USR_FAVRow.MOM_FAV_CELEB;

            if (momUsrFavorites.MOM_USR_FAVRow.MOM_FAV_MOV != null)
                momUsrFavMov.Value = momUsrFavorites.MOM_USR_FAVRow.MOM_FAV_MOV;

            if (momUsrFavorites.MOM_USR_FAVRow.MOM_FAV_TV != null)
                momUsrFavTv.Value = momUsrFavorites.MOM_USR_FAVRow.MOM_FAV_TV;

            if (momUsrFavorites.MOM_USR_FAVRow.MOM_FAV_BOOKS != null)
                momUsrFavBook.Value = momUsrFavorites.MOM_USR_FAVRow.MOM_FAV_BOOKS;

            if (momUsrFavorites.MOM_USR_FAVRow.MOM_FAV_MUSIC != null)
                momUsrFavMusic.Value = momUsrFavorites.MOM_USR_FAVRow.MOM_FAV_MUSIC;
        }
    }

    private void ShowPrivacy()
    {
        MOMUserPrivacy momUsrPrivacy = new MOMUserPrivacy();
        MOMDataset.MOM_USR_PRIVACYRow usrPrivacyRow = momUsrPrivacy.MOM_USR_PRIVACYDataTable.NewMOM_USR_PRIVACYRow();
        usrPrivacyRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
        momUsrPrivacy.MOM_USR_PRIVACYRow = usrPrivacyRow;

        momUsrPrivacy.GetMOM_User_Privacy(out isSuccess, out appMessage, out sysMessage);
        if (isSuccess)
        {
            if (momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_NAME != null)
                momPrivacyName.SelectedValue = momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_NAME;

            if (momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_DOB != null)
                momPrivacyDOB.SelectedValue = momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_DOB;

            if (momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_INTRST != null)
                momPrivacyInterest.SelectedValue = momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_INTRST;

            if (momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_EDU != null)
                momPrivacyEdu.SelectedValue = momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_EDU;

            if (momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_KIDS != null)
                momPrivacyKids.SelectedValue = momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_KIDS;

            if (momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_KIDS_DOB != null)
                momPrivacyKidsDOB.SelectedValue = momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_KIDS_DOB;

            if (momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_KIDS_PHOTO != null)
                momPrivacyKidsPhoto.SelectedValue = momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_KIDS_PHOTO;

            if (momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_KIDS_ABOUT != null)
                momPrivacyKidsAbout.SelectedValue = momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_KIDS_ABOUT;

            if (momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_KIDS_CHAN != null)
                momPrivacyKidsInterest.SelectedValue = momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_KIDS_CHAN;

            if (momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_ACT != null)
                momPrivacyLogin.SelectedValue = momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_ACT;

            if (momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_TO != null)
                momPrivacyProfile.SelectedValue = momUsrPrivacy.MOM_USR_PRIVACYRow.MOM_SHW_TO;
        }
    }

    private void ShowBlockedUsers()
    {
        MOMBlockedUsers momBlockedUsers = new MOMBlockedUsers();
        MOMDataset.MOM_BLK_USRSRow blockUserRow = momBlockedUsers.MOM_BLK_USRSDataTable.NewMOM_BLK_USRSRow();
        blockUserRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;

        momBlockUsersTable.Rows.Clear();

        HtmlTableRow row = null;
        HtmlTableCell cell = null;

        row = new HtmlTableRow();
        row.BgColor = "Gray";

        cell = new HtmlTableCell();
        cell.Width = "50%";
        cell.InnerHtml = "Display Name";
        row.Cells.Add(cell);

        cell = new HtmlTableCell();
        cell.Width = "50%";
        cell.InnerHtml = "Delete";
        row.Cells.Add(cell);

        momBlockUsersTable.Rows.Add(row);

        momBlockedUsers.MOM_BLK_USRSRow = blockUserRow;
        momBlockedUsers.GetMOM_Blocked_Users(out isSuccess, out appMessage, out sysMessage);
        if (isSuccess)
        {
            foreach (MOMDataset.MOM_BLK_USRSRow user in momBlockedUsers.MOM_BLK_USRSDataTable)
            {
                row = new HtmlTableRow();

                cell = new HtmlTableCell();
                cell.InnerHtml = user.DISPLAY_NAME;
                row.Cells.Add(cell);

                cell = new HtmlTableCell();
                cell.InnerHtml = "&nbsp;";
                row.Cells.Add(cell);

                momBlockUsersTable.Rows.Add(row);
            }
        }
    }

    protected bool showEdit()
    {
        bool show = false;
        if (Request.QueryString["q"] != null)
        {
            if (Request.QueryString["q"].ToUpper() == "EDIT")
            {
                show = true;
            }
        }
        return show;
    }

    protected bool showInfo()
    {
        bool show = true;
        if (Request.QueryString["q"] != null)
        {
            if (Request.QueryString["q"].ToUpper() == "EDIT")
            {
                show = false;
            }
        }
        return show;
    }

}
