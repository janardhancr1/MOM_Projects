using System.Web.UI;

/// <summary>
/// Summary description for TagList
/// </summary>
public class TagList : TagBase
{

    public override void RenderBeginTag(HtmlTextWriter writer)
    {
        writer.AddAttribute(HtmlTextWriterAttribute.Class, "TagListLinkWrapper");
        writer.RenderBeginTag(HtmlTextWriterTag.Span);
    }

    protected override void RenderContents(HtmlTextWriter writer)
    {
        writer.AddAttribute(HtmlTextWriterAttribute.Class, "TagListLink");
        writer.AddAttribute(HtmlTextWriterAttribute.Href, BuildTagLink);
        writer.AddAttribute(HtmlTextWriterAttribute.Title, matches);
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

