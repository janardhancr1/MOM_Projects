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

public partial class MOMQuestion_MOMAsk : System.Web.UI.Page
{
    bool isSuccess;
    string appMessage;
    string sysMessage;

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!MOMHelper.IsSessionActive())
            Response.Redirect("../MOMIndex.aspx");

        try
        {
            string categoryName = "All Categories";
            string categoryID = "0";

            MOMQuestions momQuestions = new MOMQuestions();
            MOMDataset.MOM_QSTNRow momQuestionRow = momQuestions.MOM_QSTNDataTable.NewMOM_QSTNRow();
            momQuestions.MOM_QSTNRow = momQuestionRow;

            bool qStatus = true;
            if (Request.QueryString["cI"] != null && Request.QueryString["cN"] != null)
            {
                try
                {
                    categoryID = MOMHelper.Decrypt(Request.QueryString["cI"].ToString());
                    categoryName = MOMHelper.Decrypt(Request.QueryString["cN"].ToString());

                    momQuestions.MOM_QSTNRow.MOM_CATG_ID = Int32.Parse(categoryID);
                    momQuestions.GetMOM_QSTNDataTableByMOM_CATG_ID(out isSuccess, out appMessage, out sysMessage);
                    if (isSuccess)
                    {
                        momQuestionsRepeater.DataSource = momQuestions.MOM_USR_QSTNDataTable.DefaultView;
                        momQuestionsRepeater.DataBind();
                    }
                    else
                    {
                        //TODO - show popup
                    }
                    qStatus = false;
                }
                catch
                {
                    categoryID = "0";
                    qStatus = true;
                }
            }
            if (qStatus)
            {
                momQuestions.GetMOM_QSTNDataTableByMOM_CATG_ID(out isSuccess, out appMessage, out sysMessage);
                if (isSuccess)
                {
                    if (momQuestions.MOM_USR_QSTNDataTable.Rows.Count > 0)
                    {
                        momStartIndex.Value = momQuestions.MOM_USR_QSTNDataTable[0].ID.ToString();
                        momEndIndex.Value = momQuestions.MOM_USR_QSTNDataTable
                            [momQuestions.MOM_USR_QSTNDataTable.Rows.Count - 1].ID.ToString();
                    }

                    momQuestionsRepeater.DataSource = momQuestions.MOM_USR_QSTNDataTable.DefaultView;
                    momQuestionsRepeater.DataBind();
                }
                else
                {
                    //TODO - show popup
                }
            }
            momCategoryName.Text = categoryName;

            if (momQuestions.MOM_USR_QSTNDataTable.Rows.Count == 0)
            {
                momFirstQuestion.Visible = true;
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
