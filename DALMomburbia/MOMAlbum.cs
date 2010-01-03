using System;
using System.Collections.Generic;
using System.Text;
using System.Data;
using System.Data.SqlClient;
using BOMomburbia;

namespace DALMomburbia
{
    public class MOMAlbum : MOMBase
    {
        MOMDataset.MOM_ALBMDataTable _MOM_ALBMDataTable = new MOMDataset.MOM_ALBMDataTable();
        public MOMDataset.MOM_ALBMDataTable MOM_ALBMDataTable
        {
            get { return _MOM_ALBMDataTable; }
        }

        MOMDataset.MOM_ALBMRow _MOM_ALBMRow;
        public MOMDataset.MOM_ALBMRow MOM_ALBMRow
        {
            set { _MOM_ALBMRow = value; }
            get { return _MOM_ALBMRow; }
        }

        MOMDataset.MOM_ALBM_PHTODataTable _MOM_ALBM_PHTODataTable = new MOMDataset.MOM_ALBM_PHTODataTable();
        public MOMDataset.MOM_ALBM_PHTODataTable MOM_ALBM_PHTODataTable
        {
            get { return _MOM_ALBM_PHTODataTable; }
        }

        MOMDataset.MOM_ALBM_PHTORow _MOM_ALBM_PHTORow;
        public MOMDataset.MOM_ALBM_PHTORow MOM_ALBM_PHTORow
        {
            set { _MOM_ALBM_PHTORow = value; }
            get { return _MOM_ALBM_PHTORow; }
        }

        DataTable _MOM_ALBM_USRDataTable = new DataTable();
        public DataTable MOM_ALBM_USRDataTable
        {
            get { return _MOM_ALBM_USRDataTable; }
        }

        public void AddMOM_ALBMRow(out int id, out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;
            id = 0;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_ALBM_ADD";
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_ALBMRow.MOM_USR_ID;
                momCommand.Parameters.Add("@TITLE", SqlDbType.NVarChar).Value = _MOM_ALBMRow.TITLE;
                momCommand.Parameters.Add("@DESCRIPTION", SqlDbType.NVarChar).Value = _MOM_ALBMRow.DESCRIPTION;
                momCommand.Parameters.Add("@SHARE", SqlDbType.NVarChar).Value = _MOM_ALBMRow.SHARE;
                momCommand.Parameters.Add("@ID", SqlDbType.Int).Direction = ParameterDirection.Output;

                int affectedRows = momCommand.ExecuteNonQuery();

                id = (int)momCommand.Parameters["@ID"].Value;
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

        public void AddMOM_ALBM_PHTORow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_ALBM_PHTO_ADD";
                momCommand.Parameters.Add("@MOM_ALBM_ID", SqlDbType.Int).Value = _MOM_ALBM_PHTORow.MOM_ALBM_ID;
                momCommand.Parameters.Add("@FILE_NAME", SqlDbType.NVarChar).Value = _MOM_ALBM_PHTORow.FILE_NAME;
                momCommand.Parameters.Add("@DESCRIPTION", SqlDbType.NVarChar).Value = _MOM_ALBM_PHTORow.DESCRIPTION;

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

        public void GetMOM_ALBMByMOM_USR_ID(long momUserId, out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_GET_MOM_ALBM";
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.Int).Value = momUserId;

                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;
                adapter.Fill(_MOM_ALBM_USRDataTable);
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
