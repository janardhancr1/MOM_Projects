using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Text;
using BOMomburbia;
using DALMomburbia;

namespace DALMomburbia
{
    public class MOMRecipeViews : MOMBase
    {
        MOMDataset.MOM_RCP_VIEWDataTable _MOM_RCP_VIEWDataTable = new MOMDataset.MOM_RCP_VIEWDataTable();
        public MOMDataset.MOM_RCP_VIEWDataTable MOM_RCP_VIEWDataTable
        {
            get { return _MOM_RCP_VIEWDataTable; }
        }

        MOMDataset.MOM_RCP_VIEWRow _MOM_RCP_VIEWRow;
        public MOMDataset.MOM_RCP_VIEWRow MOM_RCP_VIEWRow
        {
            get { return _MOM_RCP_VIEWRow; }
            set { _MOM_RCP_VIEWRow = value; }
        }

        public void AddMOM_RCP_VIEWRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_RCP_VIEW_ADD";

                momCommand.Parameters.Add("@MOM_RCP_ID", SqlDbType.Int).Value = _MOM_RCP_VIEWRow.MOM_RCP_ID;
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_RCP_VIEWRow.MOM_USR_ID;

                int rowsAffected = momCommand.ExecuteNonQuery();
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
