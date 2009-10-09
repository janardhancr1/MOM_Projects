using System;
using System.Collections.Generic;
using System.Text;
using System.Data.SqlClient;
using System.Data;
using System.Web;
using BOMomburbia;

namespace DALMomburbia
{
    public class MOMFridge : MOMBase 
    {
        MOMDataset.MOM_FRGDataTable _MOM_FRGDataTable = new MOMDataset.MOM_FRGDataTable();
        public MOMDataset.MOM_FRGDataTable MOM_FRGDataTable
        {
            get { return _MOM_FRGDataTable; }
        }

        MOMDataset.MOM_FRGRow _MOM_FRGRow;
        public MOMDataset.MOM_FRGRow MOM_FRGRow
        {
            get { return _MOM_FRGRow; }
            set { _MOM_FRGRow = value; }
        }

        MOMDataset.MOM_FRG_SHAREDDataTable _MOM_FRG_SHAREDDataTable = new MOMDataset.MOM_FRG_SHAREDDataTable();
        public MOMDataset.MOM_FRG_SHAREDDataTable MOM_FRG_SHAREDDataTable
        {
            get { return _MOM_FRG_SHAREDDataTable; }
        }

        MOMDataset.MOM_FRG_CMNT_SHAREDDataTable _MOM_FRG_CMNT_SHAREDDataTable = new MOMDataset.MOM_FRG_CMNT_SHAREDDataTable();
        public MOMDataset.MOM_FRG_CMNT_SHAREDDataTable MOM_FRG_CMNT_SHAREDDataTable
        {
            get { return _MOM_FRG_CMNT_SHAREDDataTable; }
        }

        MOMDataset.MOM_FRG_CMNT_SHAREDRow _MOM_FRG_CMNT_SHAREDRow;
        public MOMDataset.MOM_FRG_CMNT_SHAREDRow MOM_FRG_CMNT_SHAREDRow
        {
            set { _MOM_FRG_CMNT_SHAREDRow = value; }
            get { return _MOM_FRG_CMNT_SHAREDRow; }
        }

        public MOMFridge()
            : base()
        {
        }

        public void GetMOM_FRGDataTableByMOM_USR_ID(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_FRG_GET_BY_MOM_USR_ID";

                if (this.MOM_FRGRow.IsMOM_USR_IDNull())
                    throw new MOMException("MOM_USR_ID is null");

                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_FRGRow.MOM_USR_ID;

                if (!this.MOM_FRGRow.IsTYPE_SHARENull())
                    momCommand.Parameters.Add("@TYPE_SHARE", SqlDbType.Char).Value = _MOM_FRGRow.TYPE_SHARE;

                //momCommand.Parameters.Add("@MOM_FRG_ID", SqlDbType.Int).Value = momFrgId;
                SqlDataAdapter adapter = new SqlDataAdapter();

                MOMDataset momData = new MOMDataset();
                adapter.TableMappings.Add("Table", momData.MOM_FRG_SHARED.TableName);
                adapter.TableMappings.Add("Table1", momData.MOM_FRG_CMNT_SHARED.TableName);
                adapter.SelectCommand = momCommand;
                adapter.Fill(momData);

                _MOM_FRG_SHAREDDataTable = momData.MOM_FRG_SHARED;
                _MOM_FRG_CMNT_SHAREDDataTable = momData.MOM_FRG_CMNT_SHARED;
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

        public void AddMOM_FRGRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_FRG_ADD";

                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_FRGRow.MOM_USR_ID;
                momCommand.Parameters.Add("@SHARE", SqlDbType.NVarChar).Value = _MOM_FRGRow.SHARE;

                SqlDataAdapter adapter = new SqlDataAdapter();

                adapter.SelectCommand = momCommand;
                adapter.Fill(_MOM_FRGDataTable);
                _MOM_FRGRow = _MOM_FRGDataTable[0];
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

        public void HideMOM_FRGByID(int Id, out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_FRG_HIDE_BY_ID";
                momCommand.Parameters.Add("@ID", SqlDbType.Int).Value = Id;
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
