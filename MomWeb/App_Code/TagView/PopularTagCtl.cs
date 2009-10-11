using System;
using System.Collections.Generic;
using System.Web.UI.WebControls;

namespace App_Code.TagView
{   
    /// <summary>
    /// Summary description for PopularTagCtl
    /// </summary>
    public class PopularTagCtl : WebControl
    {
        #region Properties
        private string m_tagURL;
        public string TagURL
        {
            get { return m_tagURL; }
            set { m_tagURL = value; }
        }

        private string m_display;
        public string Display
        {
            get { return m_display.ToLower(); }
            set { m_display = value; }
        }

        private string m_tagSeparator;
        public string Separator
        {
            get { return m_tagSeparator; }
            set { m_tagSeparator = value; }
        }

        private IEnumerable<TagDataItem> m_data;
        public IEnumerable<TagDataItem> Data
        {
            set { m_data = value;}
        }
        #endregion

        protected override void CreateChildControls()
        {
            int maxCount = int.MinValue;
            int minCount = int.MaxValue;

            bool noSeparatorDefined = String.IsNullOrEmpty(m_tagSeparator);
            List<TagBase> links = new List<TagBase>();
            if (m_data != null)
            {
                foreach (TagDataItem item in m_data)
                {
                    // factory
                    TagBase tagCtl;
                    switch (Display)
                    {
                        case "cloud" : tagCtl = new TagCloud(); if (noSeparatorDefined) m_tagSeparator = " ";  break;
                        case "list"  : tagCtl = new TagList();  if (noSeparatorDefined) m_tagSeparator = ", "; break;
                        default:
                            throw new NotImplementedException("No tag view available");
                    }

                    string link = (String.IsNullOrEmpty(TagURL)) ? item.LinkPath : TagURL;
                    tagCtl.Set(item.Tag.Key, item.Tag.Value, link, Separator);

                    links.Add(tagCtl);
                    if (item.Tag.Value < minCount) minCount = item.Tag.Value;
                    if (item.Tag.Value > maxCount) maxCount = item.Tag.Value;
                }
                if (links.Count > 0) // no separator for last item
                    links[links.Count - 1].Separator = "";

            }
            foreach (TagBase link in links)
            {
                link.Size(minCount, maxCount);
                Controls.Add(link);
            }
        }
    }
}

