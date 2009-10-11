using System;
using System.Collections.Generic;
using DALMomburbia;
using BOMomburbia;

public class TagData
{
   
    public static void Sort(List<TagDataItem> items)
    {
          items.Sort(new SortComparer()); // we want them by alpha sort
    }

    public static void Limit(List<TagDataItem> items, int? count)
    {
        int requestedTagCount = count != null ? count.Value : int.MaxValue;
        if (items.Count > requestedTagCount)
            items.RemoveRange(requestedTagCount, items.Count - requestedTagCount);
    }

    public static List<TagDataItem> Get(string nameSpace, int? count, bool sort)
    {
        return get("", "", nameSpace, count, sort);
    }

    private static List<TagDataItem> get(string id, string linkPath, string nameSpace, int? count, bool sortByAlpha)
    {
        bool isSuccess;
        string appMessage;
        string sysMessage;

        System.Text.StringBuilder tagLinks = new System.Text.StringBuilder();

        List<KeyValuePair<string, int>> popularTags = new List<KeyValuePair<string, int>>();
        int requestedTagCount = count != null ? count.Value : int.MaxValue;

        MOMTags momTags = new MOMTags();
        MOMDataset.MOM_TAGSRow momTagsRow = momTags.MOM_TAGSDataTable.NewMOM_TAGSRow();
        momTagsRow.NAMESPACE = MOMHelper.MOM_RECIPE_NAMESPACE;
        momTags.MOM_TAGSRow = momTagsRow;

        momTags.GetMOM_TAGs(out isSuccess, out appMessage, out sysMessage);
        if(isSuccess)
        {
            foreach(MOMDataset.MOM_TAGSRow momTag in momTags.MOM_TAGSDataTable.Rows)
            {
                KeyValuePair<string, int> keyValue = new KeyValuePair<string, int>(momTag.TAG, Convert.ToInt32(momTag.TAG_COUNT));
                popularTags.Add(keyValue);
            }
        }

        // create a tag list
        List<TagDataItem> tagDataItems = new List<TagDataItem>();

        int cnt = 0;
        foreach (KeyValuePair<string, int> pair in popularTags)
        {
            tagDataItems.Add(new TagDataItem(pair, id, linkPath));
            if (++cnt >= requestedTagCount) break;
        }
        if (sortByAlpha)
        {
            Sort(tagDataItems);
            //if (count != null) Limit(tagDataItems, count);
        }

        // NOTE: temp fix - when service is fixed then remove and uncomment line above (below Sort(...) )
        if (count != null) Limit(tagDataItems, count);

        return tagDataItems;
    }

    private class SortComparer : IComparer<TagDataItem>
    {
        public int Compare(TagDataItem first, TagDataItem second)
        {
            return String.Compare(first.Tag.Key, second.Tag.Key);
        }
    }
}

public class TagDataItem
{
    public string ID;       // is is to allow mixing tags so we can parse out if needed
    public string LinkPath; // each tag can have it's own path when clicked
    public KeyValuePair<string, int> Tag;   // tag name / number of matches

    public TagDataItem(KeyValuePair<string, int> tag, string id, string linkPath)
    {
        Tag = tag;
        LinkPath = linkPath;
        ID = id;
    }
}