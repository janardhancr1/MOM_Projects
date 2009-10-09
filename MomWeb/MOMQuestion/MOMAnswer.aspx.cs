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

public partial class MOMQuestion_MOMAnswer : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        if (!IsPostBack)
            dataBindAnswers();
    }
    protected void momShowAnswerFrm_Click(object sender, EventArgs e)
    {
        momAnswerFrm.Visible = true;
    }

    private void dataBindAnswers()
    {
        try
        {
            int momQuestionID = Int32.Parse(MOMHelper.Decrypt(Request.QueryString["mQi"].ToString()));
            momQuestionIDHide.Text = Request.QueryString["mQi"].ToString();

            MOMQuestions momQuestions = new MOMQuestions();
            MOMDataset.MOM_QSTNRow momQuestionRow = momQuestions.MOM_QSTNDataTable.NewMOM_QSTNRow();
            momQuestionRow.ID = momQuestionID;
            momQuestions.MOM_QSTNRow = momQuestionRow;
            momQuestions.GetMOM_QSTN_MOM_USR_ANWSByMOM_QSTN_ID(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                momQuestionIDlbl.Text = MOMHelper.BreakText(MOMHelper.HTMLEncode(momQuestions.MOM_QSTNRow.QUESTION), 55);
                momDescription.Text = MOMHelper.BreakText(MOMHelper.HTMLEncode(momQuestions.MOM_QSTNRow.DESCRIPTION), 70);
                momDisplayName.Text = MOMHelper.HTMLEncode(momQuestions.MOM_QSTNRow.DISPLAY_NAME);
                momAnswersCount.Text = momQuestions.MOM_USR_ANWSDataTable.Rows.Count.ToString();

                momAnswersRpt.DataSource = momQuestions.MOM_USR_ANWSDataTable.DefaultView;
                momAnswersRpt.DataBind();
            }
            else
            {
                //TODO - show popup
            }
        }
        catch
        { }
    }

    protected void momSubmitAnswer_Click(object sender, EventArgs e)
    {
        try
        {
            MOMAnswers momAnswers = new MOMAnswers();
            MOMDataset.MOM_ANWSRow answerRow = momAnswers.MOM_ANWSDataTable.NewMOM_ANWSRow();

            MOMDataset.MOM_USRRow momUserRow = (MOMDataset.MOM_USRRow)Session["momUser"];
            answerRow.MOM_USR_ID = momUserRow.ID;
            answerRow.MOM_QSTN_ID = Int32.Parse(MOMHelper.Decrypt(momQuestionIDHide.Text));

            if (momAnswerText.Text.Trim().Length == 0)
                throw new MOMException("Very less character in the answers");

            if (momAnswerText.Text.Length > 1000)
                throw new MOMException("Only 1000 characters are allowed for the answer");

            answerRow.ANSWER = momAnswerText.Text;
            momAnswers.MOM_ANWSRow = answerRow;
            momAnswers.AddMOM_ANWSDataTable(out isSuccess, out appMessage, out sysMessage);

            if (isSuccess)
            {
                momAnswerText.Text = string.Empty;
                momAnswerFrm.Visible = false;
                dataBindAnswers();
            }
            else
            {
                //show pop up
            }

            //Response.Redirect("MOMAnswer.aspx?mQi=" + momQuestionIDHide.Text);
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
