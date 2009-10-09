using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Text;
using BOMomburbia;
using DALMomburbia;

namespace DALMomburbia
{
    public class MOMRecipeComments : MOMBase
    {
        MOMDataset.MOM_RCP_CMTDataTable _MOM_RCP_CMTDataTable = new MOMDataset.MOM_RCP_CMTDataTable();
        public MOMDataset.MOM_RCP_CMTDataTable MOM_RCP_CMTDataTable
        {
            get { return _MOM_RCP_CMTDataTable; }
        }

        MOMDataset.MOM_RCP_CMTRow _MOM_RCP_CMTRow;
        public MOMDataset.MOM_RCP_CMTRow MOM_RCP_CMTRow
        {
            get { return _MOM_RCP_CMTRow; }
            set { _MOM_RCP_CMTRow = value; }
        }

        public void AddMOM_RCP_CMTRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_RCP_CMT_ADD";

                momCommand.Parameters.Add("@MOM_RCP_ID", SqlDbType.Int).Value = _MOM_RCP_CMTRow.MOM_RCP_ID;
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_RCP_CMTRow.MOM_USR_ID;
                momCommand.Parameters.Add("@COMMENTS", SqlDbType.Text).Value = _MOM_RCP_CMTRow.COMMENTS;

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

        public void GetMOM_RCP_CMT_BY_RCP_ID(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_RCP_COMMENT_GETBY_RCP_ID";
                momCommand.Parameters.Add("@MOM_RCP_ID", SqlDbType.Int).Value = _MOM_RCP_CMTRow.MOM_RCP_ID;

                MOMDataset momData = new MOMDataset();
                momData.Clear();
                momData.EnforceConstraints = false;
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.TableMappings.Add("Table", momData.MOM_RCP_CMT.TableName);
                adapter.SelectCommand = momCommand;
                adapter.Fill(momData);

                _MOM_RCP_CMTDataTable = momData.MOM_RCP_CMT;
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
