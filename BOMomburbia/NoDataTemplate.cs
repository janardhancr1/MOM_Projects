using System;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace BOMomburbia
{
    public enum NoDataTemplateReason
    {
        NoSearchMadeYet,
        NoResultsFound,
        SystemError
    }

    /// <summary>
    /// Summary description for NoDataTemplate
    /// </summary>
    public class NoDataTemplate : ITemplate
    {
        private NoDataTemplateReason reason = NoDataTemplateReason.NoResultsFound;
        private string message = "No matching records.";

        /// <summary>
        /// New template to display when no data present for grid, defaulting Reason to
        /// NoResultsFound, and Message to ‘No matching records.’
        /// </summary>
        public NoDataTemplate()
        {
        }

        /// <summary>
        /// New template to display when no data present for grid, defaulting Reason to
        /// NoResultsFound.
        /// </summary>
        /// <param name="Message">Display this message in grid.</param>
        public NoDataTemplate(string Message)
        {
            message = Message;
        }

        /// <summary>
        /// New template to display when no data present for grid.
        /// </summary>
        /// <param name="Reason">What is the reason for no data?</param>
        /// <param name="Message">Display this message in grid.</param>
        public NoDataTemplate(NoDataTemplateReason Reason, string Message)
        {
            reason = Reason;
            message = Message;
        }

        #region ITemplate Members

        public void InstantiateIn(Control container)
        {
            string divText;
            switch (reason)
            {
                case NoDataTemplateReason.NoSearchMadeYet: divText = "SearchResultsNoSearch"; break;
                case NoDataTemplateReason.SystemError: divText = "SearchResultsError"; break;
                default: divText = "SearchResultsNoData"; break;
            }

            Label l = new Label();
            //l.Text = "<div class='" + divText + "'>" + message + "</div>";
            l.Text = "<table width='100%' cellpadding='0' cellspacing='0'>";
            l.Text += "<tr bgcolor='gray'>";
            l.Text += "<th width='40%' align='left'>";
            l.Text += "Name</th>";
            l.Text += "<th width='20%' align='left'>";
            l.Text += "BirthDay</th>";
            l.Text += "<th width='20%' align='left'>";
            l.Text += "Gender</th>";
            l.Text += "<th width='20%'>";
            l.Text += "Edit/Delete</th>";
            l.Text += "</tr>";
            l.Text += "</table>";
            container.Controls.Add(l);
        }

        #endregion
    }

}