using System;
using System.Collections.Generic;
using System.Text;
using System.Data;
using System.Data.SqlClient;
using BOMomburbia;

namespace DALMomburbia
{
    public class MOMFriend : MOMBase 
    {
        MOMDataset.MOM_USR_FRNDDataTable _MOM_USR_FRNDDataTable = new MOMDataset.MOM_USR_FRNDDataTable();
        public MOMDataset.MOM_USR_FRNDDataTable MOM_USR_FRNDDataTable
        {
            get { return _MOM_USR_FRNDDataTable; }
            set { _MOM_USR_FRNDDataTable = value; }
        }

        MOMDataset.MOM_USR_FRNDRow _MOM_USR_FRNDRow;
        public MOMDataset.MOM_USR_FRNDRow MOM_USR_FRNDRow
        {
            get { return _MOM_USR_FRNDRow; }
            set { _MOM_USR_FRNDRow = value; }
        }

        public void GetMOM_USR_FRNDDataTableByMOM_USR_ID(long momUserId, out bool isSuccess, 
            out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_FRND_GET_BY_MOM_USR_ID";
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = momUserId;

                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;

                adapter.Fill(_MOM_USR_FRNDDataTable);
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
