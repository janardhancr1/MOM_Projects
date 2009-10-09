using System;
using System.Collections.Generic;
using System.Text;
using System.Data;
using System.Data.SqlClient;
using BOMomburbia;

namespace DALMomburbia
{
    public class MOMCategories : MOMBase
    {
        private MOMDataset.MOM_CATGDataTable _MOM_CATGTable = new MOMDataset.MOM_CATGDataTable();
        public MOMDataset.MOM_CATGDataTable MOM_CATGTable
        {
            get { return _MOM_CATGTable; }
        }

        public MOMCategories()
            : base()
        {
        }

        public void GetMOM_CATTable(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_CATG_GET";
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;
                adapter.Fill(_MOM_CATGTable);
            }
            catch (MOMException X)
            {
                isSuccess = false;
                appMessage = X.Message;
            }
            catch (SqlException X)
            {
                isSuccess = false;
                appMessage = "Database Error!";
                sysMessage = X.Message;
            }
            catch (Exception X)
            {
                isSuccess = false;
                appMessage = "Application Error!";
                sysMessage = X.Message;
            }
            finally
            {
                base.CloseConnection();
            }
        }
    }
}
