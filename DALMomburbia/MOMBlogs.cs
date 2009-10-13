using System;
using System.Collections.Generic;
using System.Text;
using BOMomburbia;
using System.Data;
using System.Data.SqlClient;

namespace DALMomburbia
{
    public class MOMBlogs : MOMBase 
    {
        MOMDataset.MOM_BLGDataTable _MOM_BLGDataTable = new MOMDataset.MOM_BLGDataTable();
        public MOMDataset.MOM_BLGDataTable MOM_BLGDataTable
        {
            get { return _MOM_BLGDataTable; }
            set { _MOM_BLGDataTable = value; }
        }

        MOMDataset.MOM_BLGRow _MOM_BLGRow;
        public MOMDataset.MOM_BLGRow MOM_BLGRow
        {
            get { return _MOM_BLGRow; }
            set { _MOM_BLGRow = value; }
        }

        private MOMDataset.MOM_USR_BLGDataTable _MOM_USR_BLGDataTable = new MOMDataset.MOM_USR_BLGDataTable();
        public MOMDataset.MOM_USR_BLGDataTable MOM_USR_BLGDataTable
        {
            get { return _MOM_USR_BLGDataTable; }
            set { _MOM_USR_BLGDataTable = value; }
        }

        private DataSet _MOM_BLG_MOM_BLG_CMTDataSet = new DataSet();
        public DataSet MOM_BLG_MOM_BLG_CMTDataSet
        {
            get { return _MOM_BLG_MOM_BLG_CMTDataSet; }
        }

        public MOMBlogs()
        {
        }

        public void AddMOM_BLGRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_BLG_ADD";

                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_BLGRow.MOM_USR_ID;
                momCommand.Parameters.Add("@TITLE", SqlDbType.NVarChar).Value = _MOM_BLGRow.TITLE;
                momCommand.Parameters.Add("@BLOG", SqlDbType.NText).Value = _MOM_BLGRow.BLOG;
                momCommand.Parameters.Add("@TAGS", SqlDbType.NVarChar).Value = _MOM_BLGRow.TAGS;
                momCommand.Parameters.Add("@PRIVACY", SqlDbType.NVarChar).Value = _MOM_BLGRow.PRIVACY;
                momCommand.Parameters.Add("@ALLOW_COMMENTS", SqlDbType.Bit).Value = _MOM_BLGRow.ALLOW_COMMENTS;
                momCommand.Parameters.Add("@EMAIL_STATUS", SqlDbType.Bit).Value = _MOM_BLGRow.EMAIL_STATUS;

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

        public void GetMOM_USR_BLGDataTable(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_BLG_GET";

                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;

                adapter.Fill(_MOM_USR_BLGDataTable);

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

        public void GetMOM_BLGAndMOM_BLG_CMTByMOM_BLG_ID(int momBlogId, out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_BLG_MOM_BLG_CMT_GET_BY_MOM_BLG_ID";
                momCommand.Parameters.Add("@MOM_BLG_ID", SqlDbType.Int).Value = momBlogId;

                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;

                adapter.Fill(_MOM_BLG_MOM_BLG_CMTDataSet);

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
