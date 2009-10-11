using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Text;
using System.Data;
using BOMomburbia;
using System.Web;

namespace DALMomburbia
{
    public class MOMTags : MOMBase
    {
        private MOMDataset.MOM_TAGSDataTable _MOM_TAGSDataTable = new MOMDataset.MOM_TAGSDataTable();
        public MOMDataset.MOM_TAGSDataTable MOM_TAGSDataTable
        {
            get { return _MOM_TAGSDataTable; }
        }

        private MOMDataset.MOM_TAGSRow _MOM_TAGSRow;
        public MOMDataset.MOM_TAGSRow MOM_TAGSRow
        {
            get { return _MOM_TAGSRow; }
            set { _MOM_TAGSRow = value; }
        }

        public void GetMOM_TAGs(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_TAGS_GET_BY_NAMESPACE";
                momCommand.Parameters.Add("@NAMESPACE", SqlDbType.NVarChar).Value = _MOM_TAGSRow.NAMESPACE;
                
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;

                MOMDataset momDataSet = new MOMDataset();
                momDataSet.EnforceConstraints = false;
                adapter.TableMappings.Add("Table", momDataSet.MOM_TAGS.TableName);
                adapter.Fill(momDataSet);

                _MOM_TAGSDataTable = momDataSet.MOM_TAGS;

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
