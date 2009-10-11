using System;
using System.Data;
using System.Configuration;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using BOMomburbia;

/// <summary>
/// Summary description for RecipeBase
/// </summary>
public class RecipeBase
{
    public static bool ShowRating(string rating)
    {
        int cnt = Convert.ToInt32(rating);
        return cnt == 0 ? false : true;
    }

    public static string GetRatings(string rating)
    {
        int cnt = Convert.ToInt32(rating);
        return cnt == 0 ? MOMHelper.HTMLEncode("No Rating") : MOMHelper.HTMLEncode(cnt + " Ratings");
    }

    public static string GetViews(string viewCont)
    {
        int cnt = Convert.ToInt32(viewCont);
        return cnt == 0 ? MOMHelper.HTMLEncode("No Views") : MOMHelper.HTMLEncode(cnt + " Views");
    }

    public static string GetComments(string commentCount)
    {
        int cnt = Convert.ToInt32(commentCount);
        return cnt == 0 ? MOMHelper.HTMLEncode("No Comments") : MOMHelper.HTMLEncode(cnt + " Comments");
    }
}
