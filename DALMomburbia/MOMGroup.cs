using System;
using System.Collections.Generic;
using System.Text;
using System.Data;
using System.Data.SqlClient;
using BOMomburbia;
using System.Web;

namespace DALMomburbia
{
    public class MOMGroup : MOMBase 
    {
        MOMDataset.MOM_GRPDataTable _MOM_GRPDataTable = new MOMDataset.MOM_GRPDataTable();
        public MOMDataset.MOM_GRPDataTable MOM_GRPDataTable
        {
            get { return _MOM_GRPDataTable; }
            set { _MOM_GRPDataTable = value; }
        }

        MOMDataset.MOM_GRPRow _MOM_GRPRow;
        public MOMDataset.MOM_GRPRow MOM_GRPRow
        {
            get { return _MOM_GRPRow; }
            set { _MOM_GRPRow = value; }
        }

        MOMDataset.MOM_GRP_USRDataTable _MOM_GRP_USRDataTable = new MOMDataset.MOM_GRP_USRDataTable();
        public MOMDataset.MOM_GRP_USRDataTable MOM_GRP_USRDataTable
        {
            get { return _MOM_GRP_USRDataTable; }
            set { _MOM_GRP_USRDataTable = value; }
        }

        MOMDataset.MOM_GRP_USRRow _MOM_GRP_USRRow;
        public MOMDataset.MOM_GRP_USRRow MOM_GRP_USRRow
        {
            get { return _MOM_GRP_USRRow; }
            set { _MOM_GRP_USRRow = value; }
        }

        public void AddMOM_GRPRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_GRP_ADD";

                momCommand.Parameters.Add("@NAME", SqlDbType.NVarChar).Value = _MOM_GRPRow.NAME;
                momCommand.Parameters.Add("@TYPE", SqlDbType.NVarChar).Value = _MOM_GRPRow.TYPE;
                momCommand.Parameters.Add("@DESCRIPTION", SqlDbType.NVarChar).Value = _MOM_GRPRow.DESCRIPTION;
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_GRPRow.MOM_USR_ID;

                if(!_MOM_GRPRow.IsEMAIL_ADDRNull())
                    momCommand.Parameters.Add("@EMAIL_ADDR", SqlDbType.NVarChar).Value = _MOM_GRPRow.EMAIL_ADDR;

                if(!_MOM_GRPRow.IsRECENT_NEWSNull())
                    momCommand.Parameters.Add("@RECENT_NEWS", SqlDbType.NVarChar).Value = _MOM_GRPRow.RECENT_NEWS;

                if(!_MOM_GRPRow.IsOFFICENull())
                    momCommand.Parameters.Add("@OFFICE", SqlDbType.NVarChar).Value = _MOM_GRPRow.OFFICE;
                
                if(!_MOM_GRPRow.IsSTREETNull())
                    momCommand.Parameters.Add("@STREET", SqlDbType.NVarChar).Value = _MOM_GRPRow.STREET;

                if(!_MOM_GRPRow.IsCITYNull())
                    momCommand.Parameters.Add("@CITY", SqlDbType.NVarChar).Value = _MOM_GRPRow.CITY;

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

        public void GetMOM_GRPByMOM_USR_IDAndMOM_GRP_USRByMOM_USR_FRND(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_GRP_GET_BY_MOM_USR_ID";
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = ((MOMDataset.MOM_USRRow)HttpContext.Current.Session["momUser"]).ID;

                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;

                MOMDataset momDataSet = new MOMDataset();

                adapter.TableMappings.Add("Table", momDataSet.MOM_GRP.TableName);
                adapter.TableMappings.Add("Table1", momDataSet.MOM_GRP_USR.TableName);

                adapter.Fill(momDataSet);

                _MOM_GRPDataTable = momDataSet.MOM_GRP;
                _MOM_GRP_USRDataTable = momDataSet.MOM_GRP_USR;

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
