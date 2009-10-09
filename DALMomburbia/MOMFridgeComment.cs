using System;
using System.Collections.Generic;
using System.Text;
using System.Data;
using System.Data.SqlClient;
using BOMomburbia;
using DALMomburbia;

namespace DALMomburbia
{
    public class MOMFridgeComment : MOMBase
    {
        MOMDataset.MOM_FRG_CMNTDataTable _MOM_FRG_CMNTDataTable = new MOMDataset.MOM_FRG_CMNTDataTable();
        public MOMDataset.MOM_FRG_CMNTDataTable MOM_FRG_CMNTDataTable
        {
            get { return _MOM_FRG_CMNTDataTable; }
        }

        MOMDataset.MOM_FRG_CMNTRow _MOM_FRG_CMNTRow;
        public MOMDataset.MOM_FRG_CMNTRow MOM_FRG_CMNTRow
        {
            get { return _MOM_FRG_CMNTRow; }
            set { _MOM_FRG_CMNTRow = value; }
        }

        public MOMFridgeComment()
            : base()
        {
        }

        public void AddMOM_FRG_CMNTRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_FRG_CMNT_ADD";

                momCommand.Parameters.Add("@MOM_FRG_ID", SqlDbType.Int).Value = _MOM_FRG_CMNTRow.MOM_FRG_ID;
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_FRG_CMNTRow.MOM_USR_ID;
                momCommand.Parameters.Add("@COMMENTS", SqlDbType.NVarChar).Value = _MOM_FRG_CMNTRow.COMMENTS;
                momCommand.Parameters.Add("@ID", SqlDbType.Int).Direction = ParameterDirection.Output;

                int rowsAffected = momCommand.ExecuteNonQuery();

                _MOM_FRG_CMNTRow.ID = (int)momCommand.Parameters["@ID"].Value;
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

        public void DeleteMOM_FRG_CMNTByID(int id, out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_FRG_CMNT_DEL_BY_ID";
                momCommand.Parameters.Add("@ID", SqlDbType.Int).Value = id;
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
