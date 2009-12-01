using System;
using System.Data;
using System.Data.SqlClient;
using BOMomburbia;

namespace DALMomburbia
{
    public class MOMBlockedUsers : MOMBase
    {
        MOMDataset.MOM_BLK_USRSDataTable _MOM_BLK_USRSDataTable = new MOMDataset.MOM_BLK_USRSDataTable();
        public MOMDataset.MOM_BLK_USRSDataTable MOM_BLK_USRSDataTable
        {
            get { return _MOM_BLK_USRSDataTable; }
        }

        MOMDataset.MOM_BLK_USRSRow _MOM_BLK_USRSRow;
        public MOMDataset.MOM_BLK_USRSRow MOM_BLK_USRSRow
        {
            get { return _MOM_BLK_USRSRow; }
            set { _MOM_BLK_USRSRow = value; }
        }

        public void GetMOM_Blocked_Users(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_GET_MOM_BLK_USRS";
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_BLK_USRSRow.MOM_USR_ID;

                MOMDataset momData = new MOMDataset();
                momData.Clear();
                momData.EnforceConstraints = false;
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.TableMappings.Add("Table", momData.MOM_BLK_USRS.TableName);
                adapter.SelectCommand = momCommand;
                adapter.Fill(momData);

                _MOM_BLK_USRSDataTable = momData.MOM_BLK_USRS;

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

        public void AddMOM_BlockedUserRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_BLK_USRS_ADD";

                momCommand.Parameters.Add("@MOM_BLK_USR_ID", SqlDbType.BigInt).Value = _MOM_BLK_USRSRow.MOM_BLK_USR_ID;
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_BLK_USRSRow.MOM_USR_ID;

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
