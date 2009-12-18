using System;
using System.Collections.Generic;
using System.Text;
using System.Data;
using System.Data.SqlClient;

namespace DALMomburbia
{
    public class MOMAlbum : MOMBase
    {
        MOMDataset.MOM_ALBMDataTable _MOM_ALBMDataTable = new MOMDataset.MOM_ALBMDataTable();
        public MOMDataset.MOM_ALBMDataTable MOM_ALBMDataTable
        {
            get { return _MOM_ALBMDataTable; }
        }

        MOMDataset.MOM_ALBMRow _MOM_ALBMRow;
        public MOMDataset.MOM_ALBMRow MOM_ALBMRow
        {
            set { _MOM_ALBMRow = value; }
            get { return _MOM_ALBMRow; }
        }
    }
}
