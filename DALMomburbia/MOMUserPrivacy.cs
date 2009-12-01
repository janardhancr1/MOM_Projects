using System;
using System.Data;
using System.Data.SqlClient;
using BOMomburbia;

namespace DALMomburbia
{
    public class MOMUserPrivacy : MOMBase
    {
        MOMDataset.MOM_USR_PRIVACYDataTable _MOM_USR_PRIVACYDataTable = new MOMDataset.MOM_USR_PRIVACYDataTable();
        public MOMDataset.MOM_USR_PRIVACYDataTable MOM_USR_PRIVACYDataTable
        {
            get { return _MOM_USR_PRIVACYDataTable; }
        }

        MOMDataset.MOM_USR_PRIVACYRow _MOM_USR_PRIVACYRow;
        public MOMDataset.MOM_USR_PRIVACYRow MOM_USR_PRIVACYRow
        {
            get { return _MOM_USR_PRIVACYRow; }
            set { _MOM_USR_PRIVACYRow = value; }
        }

        public void GetMOM_User_Privacy(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_GET_MOM_USR_PRIVACY";
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_USR_PRIVACYRow.MOM_USR_ID;

                MOMDataset momData = new MOMDataset();
                momData.Clear();
                momData.EnforceConstraints = false;
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.TableMappings.Add("Table", momData.MOM_USR_PRIVACY.TableName);
                adapter.SelectCommand = momCommand;
                adapter.Fill(momData);

                _MOM_USR_PRIVACYRow = momData.MOM_USR_PRIVACY[0];
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

        public void UpdateMOM_UserPrivacyRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_USR_PRIVACY_UPDATE";

                if (!_MOM_USR_PRIVACYRow.IsMOM_SHW_NAMENull())
                    momCommand.Parameters.Add("@MOM_SHW_NAME", SqlDbType.NVarChar).Value = _MOM_USR_PRIVACYRow.MOM_SHW_NAME;
                if (!_MOM_USR_PRIVACYRow.IsMOM_SHW_DOBNull())
                    momCommand.Parameters.Add("@MOM_SHW_DOB", SqlDbType.NVarChar).Value = _MOM_USR_PRIVACYRow.MOM_SHW_DOB;
                if (!_MOM_USR_PRIVACYRow.IsMOM_SHW_INTRSTNull())
                    momCommand.Parameters.Add("@MOM_SHW_INTRST", SqlDbType.NVarChar).Value = _MOM_USR_PRIVACYRow.MOM_SHW_INTRST;
                if (!_MOM_USR_PRIVACYRow.IsMOM_SHW_EDUNull())
                    momCommand.Parameters.Add("@MOM_SHW_EDU", SqlDbType.NVarChar).Value = _MOM_USR_PRIVACYRow.MOM_SHW_EDU;
                if (!_MOM_USR_PRIVACYRow.IsMOM_SHW_KIDSNull())
                    momCommand.Parameters.Add("@MOM_SHW_KIDS", SqlDbType.NVarChar).Value = _MOM_USR_PRIVACYRow.MOM_SHW_KIDS;
                if (!_MOM_USR_PRIVACYRow.IsMOM_SHW_KIDS_DOBNull())
                    momCommand.Parameters.Add("@MOM_SHW_KIDS_DOB", SqlDbType.NVarChar).Value = _MOM_USR_PRIVACYRow.MOM_SHW_KIDS_DOB;
                if (!_MOM_USR_PRIVACYRow.IsMOM_SHW_KIDS_PHOTONull())
                    momCommand.Parameters.Add("@MOM_SHW_KIDS_PHOTO", SqlDbType.NVarChar).Value = _MOM_USR_PRIVACYRow.MOM_SHW_KIDS_PHOTO;
                if (!_MOM_USR_PRIVACYRow.IsMOM_SHW_KIDS_ABOUTNull())
                    momCommand.Parameters.Add("@MOM_SHW_KIDS_ABOUT", SqlDbType.NVarChar).Value = _MOM_USR_PRIVACYRow.MOM_SHW_KIDS_ABOUT;
                if (!_MOM_USR_PRIVACYRow.IsMOM_SHW_KIDS_CHANNull())
                    momCommand.Parameters.Add("@MOM_SHW_KIDS_CHAN", SqlDbType.NVarChar).Value = _MOM_USR_PRIVACYRow.MOM_SHW_KIDS_CHAN;
                if (!_MOM_USR_PRIVACYRow.IsMOM_SHW_ACTNull())
                    momCommand.Parameters.Add("@MOM_SHW_ACT", SqlDbType.NVarChar).Value = _MOM_USR_PRIVACYRow.MOM_SHW_ACT;
                if (!_MOM_USR_PRIVACYRow.IsMOM_SHW_TONull())
                    momCommand.Parameters.Add("@MOM_SHW_TO", SqlDbType.NVarChar).Value = _MOM_USR_PRIVACYRow.MOM_SHW_TO;
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_USR_PRIVACYRow.MOM_USR_ID;

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
