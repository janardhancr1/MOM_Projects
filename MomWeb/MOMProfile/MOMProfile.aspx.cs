using System;
using System.Data;
using System.Data.SqlClient;
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

public partial class MOMProfile_MOMProfile : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");
    }

    protected void ChangeMenu(object sender, EventArgs e)
    {
        string s = ((HtmlAnchor)sender).Name;
        MultiView1.ActiveViewIndex = Int32.Parse(s);
        switch (MultiView1.ActiveViewIndex)
        {
            case 1:
                MOMUsers momUsers = new MOMUsers();
                momUsers.GetUserByName(out isSuccess, out appMessage, out sysMessage, ((MOMDataset.MOM_USRRow)Session["momUser"]).DISPLAY_NAME);
                if (isSuccess)
                {
                    momFirstName.Text = momUsers.MOM_USRRow.FIRST_NAME;
                    momLastName.Text = momUsers.MOM_USRRow.LAST_NAME;
                    momEmail.Text = momUsers.MOM_USRRow.EMAIL_ADDR;
                    momZipCode.Text = momUsers.MOM_USRRow.ZIP;
                    momLocation.Text = momUsers.MOM_USRRow.LOCATION;
                    momCountry.SelectedValue = momUsers.MOM_USRRow.COUNTRY;
                    momDisplayName.Text = momUsers.MOM_USRRow.DISPLAY_NAME;

                    if (momUsers.MOM_USRRow.INTEREST != null)
                        momUserInterests.Value = momUsers.MOM_USRRow.INTEREST;
                }

                ShowKids();
                ShowSchools();
                ShowFavorites();

                break;
            case 0:
                break;
        }
    }

    protected void Kids_Load(object sender, EventArgs e)
    {
        string s = momProfileAccordion.SelectedIndex.ToString();
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
                cell.InnerHtml = "&nbsp;";
                row.Cells.Add(cell);

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
}
