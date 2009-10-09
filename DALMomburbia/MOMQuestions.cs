using System;
using System.Collections.Generic;
using System.Text;
using System.Data;
using System.Data.SqlClient;
using BOMomburbia;

namespace DALMomburbia
{
    public class MOMQuestions : MOMBase 
    {
        MOMDataset.MOM_QSTNDataTable _MOM_QSTNDataTable = new MOMDataset.MOM_QSTNDataTable();
        public MOMDataset.MOM_QSTNDataTable MOM_QSTNDataTable
        {
            get { return _MOM_QSTNDataTable; }
        }

        MOMDataset.MOM_QSTNRow _MOM_QSTNRow;
        public MOMDataset.MOM_QSTNRow MOM_QSTNRow
        {
            get { return _MOM_QSTNRow; }
            set { _MOM_QSTNRow = value; }
        }

        MOMDataset.MOM_USR_QSTNDataTable _MOM_USR_QSTNDataTable = new MOMDataset.MOM_USR_QSTNDataTable();
        public MOMDataset.MOM_USR_QSTNDataTable MOM_USR_QSTNDataTable
        {
            get { return _MOM_USR_QSTNDataTable; }
        }

        MOMDataset.MOM_USR_QSTNRow _MOM_USR_QSTNRow;
        public MOMDataset.MOM_USR_QSTNRow MOM_USR_QSTNRow
        {
            get { return _MOM_USR_QSTNRow; }
            set { _MOM_USR_QSTNRow = value; }
        }

        MOMDataset.MOM_USR_ANWSDataTable _MOM_USR_ANWSDataTable = new MOMDataset.MOM_USR_ANWSDataTable();
        public MOMDataset.MOM_USR_ANWSDataTable MOM_USR_ANWSDataTable
        {
            get { return _MOM_USR_ANWSDataTable; }
        }

        public MOMQuestions() : base()
        {
        }

        public void GetMOM_QSTNDataTableByMOM_CATG_ID(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_QSTN_GET_BY_MOM_CATG_ID";
                if(!this._MOM_QSTNRow.IsMOM_CATG_IDNull())
                    momCommand.Parameters.Add("@MOM_CATG_ID", SqlDbType.Int).Value = this.MOM_QSTNRow.MOM_CATG_ID;

                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;

                adapter.Fill(_MOM_USR_QSTNDataTable);
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

        public void GetMOM_QSTN_MOM_USR_ANWSByMOM_QSTN_ID(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_QSTN_MOM_ANWS_GET_BY_MOM_QSTN_ID";
                momCommand.Parameters.Add("@ID", SqlDbType.Int).Value = _MOM_QSTNRow.ID;

                MOMDataset momData = new MOMDataset();
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.TableMappings.Add("Table", momData.MOM_QSTN.TableName);
                adapter.TableMappings.Add("Table1", momData.MOM_USR_ANWS.TableName);
                adapter.SelectCommand = momCommand;
                adapter.Fill(momData);

                _MOM_QSTNRow = momData.MOM_QSTN[0];
                _MOM_USR_ANWSDataTable = momData.MOM_USR_ANWS;
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

        public void GetMOM_QSTNDataTableByID(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_QSTN_GET_BY_ID";
                momCommand.Parameters.Add("@ID", SqlDbType.Int).Value = _MOM_QSTNRow.ID;
                SqlDataAdapter adaper = new SqlDataAdapter();
                adaper.SelectCommand = momCommand;
                adaper.Fill(_MOM_QSTNDataTable);

                _MOM_QSTNRow = _MOM_QSTNDataTable[0];
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

        public void AddMOM_QSTNRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_QSTN_ADD";
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_QSTNRow.MOM_USR_ID;
                momCommand.Parameters.Add("@MOM_CATG_ID", SqlDbType.Int).Value = _MOM_QSTNRow.MOM_CATG_ID;
                momCommand.Parameters.Add("@QUESTION", SqlDbType.NVarChar).Value = _MOM_QSTNRow.QUESTION;
                momCommand.Parameters.Add("@DESCRIPTION", SqlDbType.NVarChar).Value = _MOM_QSTNRow.DESCRIPTION;
                momCommand.Parameters.Add("@EMAIL_STATUS", SqlDbType.Bit).Value = _MOM_QSTNRow.EMAIL_STATUS;

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
