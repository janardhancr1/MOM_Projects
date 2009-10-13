using System;
using System.Collections.Generic;
using System.Text;
using System.Data.SqlClient;
using System.Text;
using BOMomburbia;
using DALMomburbia;
using System.Data;

namespace DALMomburbia
{
    public class MOMBlogComment : MOMBase 
    {
        MOMDataset.MOM_BLG_CMTDataTable _MOM_BLG_CMTDataTable = new MOMDataset.MOM_BLG_CMTDataTable();
        public MOMDataset.MOM_BLG_CMTDataTable MOM_BLG_CMTDataTable
        {
            get { return _MOM_BLG_CMTDataTable; }
            set { _MOM_BLG_CMTDataTable = value; }
        }

        MOMDataset.MOM_BLG_CMTRow _MOM_BLG_CMTRow;
        public MOMDataset.MOM_BLG_CMTRow MOM_BLG_CMTRow
        {
            get { return _MOM_BLG_CMTRow; }
            set { _MOM_BLG_CMTRow = value; }
        }

        public void AddMOM_BLG_CMTRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_BLG_CMT_ADD";

                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_BLG_CMTRow.MOM_USR_ID;
                momCommand.Parameters.Add("@MOM_BLG_ID", SqlDbType.Int).Value = _MOM_BLG_CMTRow.MOM_BLG_ID;
                momCommand.Parameters.Add("@COMMENTS", SqlDbType.Text).Value = _MOM_BLG_CMTRow.COMMENTS;

                int rowsAffected = momCommand.ExecuteNonQuery();
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
