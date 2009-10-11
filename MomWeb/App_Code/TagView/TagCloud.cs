using System.Web.UI;

/// <summary>
/// Summary description for TagCloud
/// </summary>
public class TagCloud : TagBase
{

    public override void RenderBeginTag(HtmlTextWriter writer)
    {
        writer.AddAttribute(HtmlTextWriterAttribute.Class, "TagCloudLinkWrapper");
        writer.RenderBeginTag(HtmlTextWriterTag.Span);
    }

    protected override void RenderContents(HtmlTextWriter writer)
    {
        writer.AddAttribute(HtmlTextWriterAttribute.Class, "TagCloudLink");
        writer.AddAttribute(HtmlTextWriterAttribute.Href, BuildTagLink);
        writer.AddAttribute(HtmlTextWriterAttribute.Title, matches);
        writer.AddStyleAttribute(HtmlTextWriterStyle.FontSize, m_Size + "%");
        writer.RenderBeginTag(HtmlTextWriterTag.A);
        writer.Write(m_Tag);
        writer.RenderEndTag();
        writer.Write(m_separator);
    }

    public override void RenderEndTag(HtmlTextWriter writer)
    {
        writer.RenderEndTag();
    }
}

