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
using System.Data.SqlClient;
using BOMomburbia;
using DALMomburbia;

public partial class MOMQuestion_MOMQuestions : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        if (!Page.IsPostBack)
        {
            try
            {
                MOMCategories momCategory = new MOMCategories();
                MOMDataset.MOM_CATGRow momCategoryRow = momCategory.MOM_CATGTable.NewMOM_CATGRow();
                momCategory.GetMOM_CATTable(out isSuccess, out appMessage, out sysMessage);

                if (isSuccess)
                {
                    momCategories.DataSource = momCategory.MOM_CATGTable.DefaultView;
                    foreach (MOMDataset.MOM_CATGRow myRow in momCategory.MOM_CATGTable.Rows)
                    {
                        ListItem l = new ListItem();
                        l.Text = myRow.NAME;
                        l.Value = MOMHelper.Encrypt(myRow.ID.ToString());
                        momCategories.Items.Add(l);
                    }
                }
                else
                {
                }
            }
            catch (Exception X)
            {

            }
        }
    }
    protected void momSubmitQuestion_Click(object sender, EventArgs e)
    {
        try
        {
            if (momQuestionTextBox.Text.Trim().Length == 0)
                throw new MOMException("Very less characters in your Questions");

            if (momQuestionTextBox.Text.Length > 100)
                throw new MOMException("Your Quesion cannot exceed 100 characters");

            if (momQuestionDescription.Text.Length > 2000)
                throw new MOMException("Your Description cannot exceed 2000 characters");

            MOMQuestions momQuestion = new MOMQuestions();
            MOMDataset.MOM_QSTNRow momQuestionRow = momQuestion.MOM_QSTNDataTable.NewMOM_QSTNRow();
            momQuestionRow.MOM_USR_ID = ((MOMDataset.MOM_USRRow)Session["momUser"]).ID;
            momQuestionRow.QUESTION = momQuestionTextBox.Text;
            momQuestionRow.DESCRIPTION = momQuestionDescription.Text;
            momQuestionRow.MOM_CATG_ID = Int32.Parse(MOMHelper.Decrypt(momCategories.SelectedValue));
            momQuestionRow.EMAIL_STATUS = momEmailStatus.Checked;
            momQuestion.MOM_QSTNRow = momQuestionRow;
            momQuestion.AddMOM_QSTNRow(out isSuccess, out appMessage, out sysMessage);
            if (isSuccess)
            {
                Response.Redirect("MOMQuestionDefault.aspx");
            }
            else
            {
                //TODO - show popup
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
