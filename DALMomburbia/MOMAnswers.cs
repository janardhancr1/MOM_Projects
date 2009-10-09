using System;
using System.Collections.Generic;
using System.Text;
using System.Data;
using System.Data.SqlClient;
using BOMomburbia;

namespace DALMomburbia
{
    public class MOMAnswers : MOMBase
    {
        MOMDataset.MOM_ANWSDataTable _MOM_ANWSDataTable = new MOMDataset.MOM_ANWSDataTable();
        public MOMDataset.MOM_ANWSDataTable MOM_ANWSDataTable
        {
            get { return _MOM_ANWSDataTable; }
        }

        MOMDataset.MOM_USR_ANWSDataTable _MOM_USR_ANWSDataTable = new MOMDataset.MOM_USR_ANWSDataTable();
        public MOMDataset.MOM_USR_ANWSDataTable MOM_USR_ANWSDataTable
        {
            get { return _MOM_USR_ANWSDataTable; }
        }

        MOMDataset.MOM_ANWSRow _MOM_ANWSRow;
        public MOMDataset.MOM_ANWSRow MOM_ANWSRow
        {
            set { _MOM_ANWSRow = value; }
            get { return _MOM_ANWSRow; }
        }

        public MOMAnswers()
            : base()
        {
        }

        public void GetMOM_USR_ANWSDataTableByMOM_QSTN_ID(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_ANWS_GET_BY_MOM_QSTN_ID";
                momCommand.Parameters.Add("@MOM_QSTN_ID", SqlDbType.Int).Value = _MOM_ANWSRow.MOM_QSTN_ID;

                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;
                adapter.Fill(_MOM_USR_ANWSDataTable);
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

        public void AddMOM_ANWSDataTable(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_ANSW_ADD";
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = this._MOM_ANWSRow.MOM_USR_ID;
                momCommand.Parameters.Add("@MOM_QSTN_ID", SqlDbType.Int).Value = this._MOM_ANWSRow.MOM_QSTN_ID;
                momCommand.Parameters.Add("@ANSWER", SqlDbType.NVarChar).Value = this._MOM_ANWSRow.ANSWER;

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
