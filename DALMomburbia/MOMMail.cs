using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Text;
using System.Data;
using BOMomburbia;
using System.Web;

namespace DALMomburbia
{
    public class MOMMail : MOMBase
    {
        MOMDataset.MOM_MAILDataTable _MOM_MAILDataTable = new MOMDataset.MOM_MAILDataTable();
        public MOMDataset.MOM_MAILDataTable MOM_MAILDataTable
        {
            get { return _MOM_MAILDataTable; }
        }

        MOMDataset.MOM_MAILRow _MOM_MAILRow;
        public MOMDataset.MOM_MAILRow MOM_MAILRow
        {
            get { return _MOM_MAILRow; }
            set { _MOM_MAILRow = value; }
        }

        public void AddMOM_MAILRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_MAIL_ADD";

                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.NVarChar).Value = _MOM_MAILRow.MOM_USR_ID;
                momCommand.Parameters.Add("@MOM_TO_EMAIL", SqlDbType.NVarChar).Value = _MOM_MAILRow.MOM_TO_EMAIL;
                momCommand.Parameters.Add("@MOM_SUBJECT", SqlDbType.NVarChar).Value = _MOM_MAILRow.MOM_SUBJECT;
                momCommand.Parameters.Add("@MOM_BODY", SqlDbType.NVarChar).Value = _MOM_MAILRow.MOM_BODY;

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

        public void GetMOM_MAILS(out bool isSuccess, out string appMessage, out string sysMessage, string displayName)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_GET_MAILS";

                momCommand.Parameters.Add("@MOM_USR_NAME", SqlDbType.NVarChar).Value = displayName;

                MOMDataset momData = new MOMDataset();
                momData.Clear();
                momData.EnforceConstraints = false;
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.TableMappings.Add("Table", momData.MOM_MAIL.TableName);
                adapter.SelectCommand = momCommand;
                adapter.Fill(momData);

                _MOM_MAILDataTable = momData.MOM_MAIL;
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

        public void GetMOM_SEND_MAILS(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_SEND_MAILS";

                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.NVarChar).Value = _MOM_MAILRow.MOM_USR_ID;

                MOMDataset momData = new MOMDataset();
                momData.Clear();
                momData.EnforceConstraints = false;
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.TableMappings.Add("Table", momData.MOM_MAIL.TableName);
                adapter.SelectCommand = momCommand;
                adapter.Fill(momData);

                _MOM_MAILDataTable = momData.MOM_MAIL;

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

        public int GetMOM_NEW_MAILS(out bool isSuccess, out string appMessage, out string sysMessage, string displayName)
        {
            int affectedRows = 0;
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_GET_NEW_MAILS";

                momCommand.Parameters.Add("@MOM_USR_NAME", SqlDbType.NVarChar).Value = displayName;
                momCommand.Parameters.Add("@MOM_READ", SqlDbType.NVarChar).Value = false;

                affectedRows = (int)momCommand.ExecuteScalar();
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

            return affectedRows;
        }


        public int GetMOM_MAIL_BY_ID(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            int affectedRows = 0;
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_MAIL_GET_BY_ID";

                momCommand.Parameters.Add("@MAIL_ID", SqlDbType.NVarChar).Value = _MOM_MAILRow.ID;

                MOMDataset momData = new MOMDataset();
                momData.Clear();
                momData.EnforceConstraints = false;
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.TableMappings.Add("Table", momData.MOM_MAIL.TableName);
                adapter.SelectCommand = momCommand;
                adapter.Fill(momData);

                _MOM_MAILRow = momData.MOM_MAIL[0];
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

            return affectedRows;
        }

        public int SetMOM_MAIL_MARK_READ(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            int affectedRows = 0;
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_MAIL_READ";

                momCommand.Parameters.Add("@ID", SqlDbType.NVarChar).Value = _MOM_MAILRow.ID;
                momCommand.Parameters.Add("@MOM_READ", SqlDbType.NVarChar).Value = _MOM_MAILRow.MOM_READ;

                affectedRows = momCommand.ExecuteNonQuery();
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

            return affectedRows;
        }
    }
}
