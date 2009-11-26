using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Text;
using BOMomburbia;

namespace DALMomburbia
{
    public class MOMUserEducation : MOMBase
    {
        MOMDataset.MOM_USR_EDUDataTable _MOM_USR_EDUDataTable = new MOMDataset.MOM_USR_EDUDataTable();
        public MOMDataset.MOM_USR_EDUDataTable MOM_USR_EDUDataTable
        {
            get { return _MOM_USR_EDUDataTable; }
        }

        MOMDataset.MOM_USR_EDURow _MOM_USR_EDURow;
        public MOMDataset.MOM_USR_EDURow MOM_USR_EDURow
        {
            get { return _MOM_USR_EDURow; }
            set { _MOM_USR_EDURow = value; }
        }

        public void GetMOM_Usr_EDU(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_GET_MOM_USR_EDU";
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.Int).Value = _MOM_USR_EDURow.MOM_USR_ID;

                MOMDataset momData = new MOMDataset();
                momData.Clear();
                momData.EnforceConstraints = false;
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.TableMappings.Add("Table", momData.MOM_USR_EDU.TableName);
                adapter.SelectCommand = momCommand;
                adapter.Fill(momData);

                _MOM_USR_EDUDataTable = momData.MOM_USR_EDU;
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

        public void AddMOM_USR_EDURow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_USR_EDU_ADD";

                momCommand.Parameters.Add("@MOM_SCH_NAME", SqlDbType.VarChar).Value = _MOM_USR_EDURow.MOM_SCH_NAME;
                momCommand.Parameters.Add("@MOM_SCH_TYPE", SqlDbType.VarChar).Value = _MOM_USR_EDURow.MOM_SCH_TYPE;
                if (!_MOM_USR_EDURow.IsMOM_SCH_STNull())
                    momCommand.Parameters.Add("@MOM_SCH_ST", SqlDbType.Int).Value = _MOM_USR_EDURow.MOM_SCH_ST;
                if (!_MOM_USR_EDURow.IsMOM_SCH_EDNull())
                    momCommand.Parameters.Add("@MOM_SCH_ED", SqlDbType.Int).Value = _MOM_USR_EDURow.MOM_SCH_ED;
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_USR_EDURow.MOM_USR_ID;

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
