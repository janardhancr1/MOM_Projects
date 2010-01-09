using System;
using System.Collections.Generic;
using System.Text;
using System.Data;
using System.Data.SqlClient;
using BOMomburbia;

namespace DALMomburbia
{
    class MOMVideo : MOMBase 
    {
        MOMDataset.MOM_VIDDataTable _MOM_VIDDataTable = new MOMDataset.MOM_VIDDataTable();
        public MOMDataset.MOM_VIDDataTable MOM_VIDDataTable
        {
            get { return _MOM_VIDDataTable; }
        }

        MOMDataset.MOM_VIDRow _MOM_VIDRow;
        public MOMDataset.MOM_VIDRow MOM_VIDRow
        {
            get { return _MOM_VIDRow; }
            set { _MOM_VIDRow = value; }
        }

        DataTable _MOM_VID_DISPDataTable = new DataTable();
        public DataTable MOM_VID_DISPDataTable
        {
            get { return _MOM_VID_DISPDataTable; }
        }

        public void AddMOM_VIDRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_VID_ADD";
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_VIDRow.MOM_USR_ID;
                momCommand.Parameters.Add("@TITLE", SqlDbType.NVarChar).Value = _MOM_VIDRow.TITLE;
                momCommand.Parameters.Add("@DESCRIPTION", SqlDbType.NVarChar).Value = _MOM_VIDRow.DESCRIPTION;
                momCommand.Parameters.Add("@SHARE", SqlDbType.NVarChar).Value = _MOM_VIDRow.SHARE;

                int affectedRows = momCommand.ExecuteNonQuery();
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
