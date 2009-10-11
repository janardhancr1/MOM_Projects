using System.Web.UI.WebControls;
using BOMomburbia;

public abstract class TagBase : WebControl
{
    protected string m_Tag;
    protected int m_Count;
    protected string m_Link;
    protected int m_Size;
    protected string m_separator;

    public void Set(string tag, int count, string link, string separator)
    {
        m_Tag = tag;
        m_Count = count;
        m_Link = link;
        m_separator = separator;
    }

    public string Separator
    {
        set { m_separator = value; }
    }

    protected string matches
    {
        get { return m_Count + " match" + ((m_Count == 1) ? "" : "es"); }
    }

    public void Size(int minCount, int maxCount)
    {
        m_Size = 100 + (int)(100.0 * (m_Count - minCount) / (maxCount - minCount));
    }

    // builds link based on passed path, tag name, and optional placeholder
    // can create path as follows:
    // /path/folder/ [tag name goes here]
    // /path/folder/{0}/subfolder where {0} acts as placeholder for tag
    protected string BuildTagLink
    {
        get
        {
            if (m_Link.Contains("{0}"))
                return string.Format(m_Link, MOMHelper.Encrypt(m_Tag));
            else
                return m_Link + MOMHelper.Encrypt(m_Tag);  
        }
    }
}
