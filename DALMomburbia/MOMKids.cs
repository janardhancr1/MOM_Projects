using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Text;
using BOMomburbia;

namespace DALMomburbia
{
    public class MOMKids : MOMBase
    {
        MOMDataset.MOM_KIDSDataTable _MOM_KIDSDataTable = new MOMDataset.MOM_KIDSDataTable();
        public MOMDataset.MOM_KIDSDataTable MOM_KIDSDataTable
        {
            get { return _MOM_KIDSDataTable; }
        }

        MOMDataset.MOM_KIDSRow _MOM_KIDSRow;
        public MOMDataset.MOM_KIDSRow MOM_KIDSRow
        {
            get { return _MOM_KIDSRow; }
            set { _MOM_KIDSRow = value; }
        }

        public void GetMOM_KidsBy_UsrID(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_KIDS_BY_USR_ID";
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.Int).Value = _MOM_KIDSRow.MOM_USR_ID;

                MOMDataset momData = new MOMDataset();
                momData.Clear();
                momData.EnforceConstraints = false;
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.TableMappings.Add("Table", momData.MOM_KIDS.TableName);
                adapter.SelectCommand = momCommand;
                adapter.Fill(momData);

                _MOM_KIDSDataTable = momData.MOM_KIDS;
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
