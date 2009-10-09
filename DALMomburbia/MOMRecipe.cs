using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Text;
using System.Data;
using BOMomburbia;
using System.Web;

namespace DALMomburbia
{
    public class MOMRecipe : MOMBase
    {
        MOMDataset.MOM_RCPDataTable _MOM_RCPDataTable = new MOMDataset.MOM_RCPDataTable();
        public MOMDataset.MOM_RCPDataTable MOM_RCPDataTable
        {
            get { return _MOM_RCPDataTable; }
        }

        MOMDataset.MOM_RCPRow _MOM_RCPRow;
        public MOMDataset.MOM_RCPRow MOM_RCPRow
        {
            get { return _MOM_RCPRow; }
            set { _MOM_RCPRow = value; }
        }

        MOMDataset.MOM_RCP_SEARCHDataTable _MOM_RCP_SEARCHDataTable = new MOMDataset.MOM_RCP_SEARCHDataTable();
        public MOMDataset.MOM_RCP_SEARCHDataTable MOM_RCP_SEARCHDataTable
        {
            get { return _MOM_RCP_SEARCHDataTable; }
        }

        MOMDataset.MOM_RCP_SEARCHRow _MOM_RCP_SEARCHRow;
        public MOMDataset.MOM_RCP_SEARCHRow MOM_RCP_SEARCHRow
        {
            get { return _MOM_RCP_SEARCHRow; }
            set { _MOM_RCP_SEARCHRow = value; }
        }

        public void AddMOM_RCPRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_RCP_ADD";

                momCommand.Parameters.Add("@NAME", SqlDbType.NVarChar).Value = _MOM_RCPRow.NAME;
                momCommand.Parameters.Add("@DESCRIPTION", SqlDbType.NVarChar).Value = _MOM_RCPRow.DESCRIPTION;
                momCommand.Parameters.Add("@DIFFICULTY", SqlDbType.NVarChar).Value = _MOM_RCPRow.DIFFICULTY;
                momCommand.Parameters.Add("@INGREDIENTS", SqlDbType.NVarChar).Value = _MOM_RCPRow.INGREDIENTS;
                momCommand.Parameters.Add("@METHOD", SqlDbType.NVarChar).Value = _MOM_RCPRow.METHOD;
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_RCPRow.MOM_USR_ID;

                if (!_MOM_RCPRow.IsPHOTONull())
                    momCommand.Parameters.Add("@PHOTO", SqlDbType.NVarChar).Value = _MOM_RCPRow.PHOTO;

                if (!_MOM_RCPRow.IsTAGSNull())
                    momCommand.Parameters.Add("@TAGS", SqlDbType.NVarChar).Value = _MOM_RCPRow.TAGS;

                if (!_MOM_RCPRow.IsPREP_TMNull())
                    momCommand.Parameters.Add("@PREP_TM", SqlDbType.NVarChar).Value = _MOM_RCPRow.PREP_TM;

                if (!_MOM_RCPRow.IsCOOK_TMNull())
                    momCommand.Parameters.Add("@COOK_TM", SqlDbType.NVarChar).Value = _MOM_RCPRow.COOK_TM;

                if (!_MOM_RCPRow.IsSERVE_TONull())
                    momCommand.Parameters.Add("@SERVE_TO", SqlDbType.NVarChar).Value = _MOM_RCPRow.SERVE_TO;

                if (!_MOM_RCPRow.IsVEGENull())
                    momCommand.Parameters.Add("@VEGE", SqlDbType.NVarChar).Value = _MOM_RCPRow.VEGE;

                if (!_MOM_RCPRow.IsVEGANNull())
                    momCommand.Parameters.Add("@VEGAN", SqlDbType.NVarChar).Value = _MOM_RCPRow.VEGAN;

                if (!_MOM_RCPRow.IsDAIRYNull())
                    momCommand.Parameters.Add("@DAIRY", SqlDbType.NVarChar).Value = _MOM_RCPRow.DAIRY;

                if (!_MOM_RCPRow.IsGLUTENNull())
                    momCommand.Parameters.Add("@GLUTEN", SqlDbType.NVarChar).Value = _MOM_RCPRow.GLUTEN;

                if (!_MOM_RCPRow.IsNUTNull())
                    momCommand.Parameters.Add("@NUT", SqlDbType.NVarChar).Value = _MOM_RCPRow.NUT;

                if (!_MOM_RCPRow.IsALLOWNull())
                    momCommand.Parameters.Add("@ALLOW", SqlDbType.NVarChar).Value = _MOM_RCPRow.ALLOW;

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

        public void GetMOM_RCPBy_ID(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_RCP_GET_BY_ID";
                momCommand.Parameters.Add("@ID", SqlDbType.Int).Value = _MOM_RCPRow.ID;

                MOMDataset momData = new MOMDataset();
                momData.Clear();
                momData.EnforceConstraints = false;
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.TableMappings.Add("Table", momData.MOM_RCP.TableName);
                adapter.SelectCommand = momCommand;
                adapter.Fill(momData);

                _MOM_RCPRow = momData.MOM_RCP[0];
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

        public void GetMOM_RCPs(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_RCP_SEARCH";
                momCommand.Parameters.Add("@NAME", SqlDbType.NVarChar).Value = _MOM_RCPRow.NAME;
                momCommand.Parameters.Add("@DIFFICULTY", SqlDbType.NVarChar).Value = _MOM_RCPRow.DIFFICULTY;

                if (_MOM_RCPRow.INGREDIENTS.Equals("True"))
                    momCommand.Parameters.Add("@INGREDIENTS", SqlDbType.NVarChar).Value = _MOM_RCPRow.INGREDIENTS;

                if (!_MOM_RCPRow.IsPHOTONull())
                    momCommand.Parameters.Add("@PHOTO", SqlDbType.NVarChar).Value = _MOM_RCPRow.PHOTO;

                if (!_MOM_RCPRow.IsVEGENull())
                    momCommand.Parameters.Add("@VEGE", SqlDbType.NVarChar).Value = _MOM_RCPRow.VEGE;

                if (!_MOM_RCPRow.IsVEGANNull())
                    momCommand.Parameters.Add("@VEGAN", SqlDbType.NVarChar).Value = _MOM_RCPRow.VEGAN;

                if (!_MOM_RCPRow.IsDAIRYNull())
                    momCommand.Parameters.Add("@DAIRY", SqlDbType.NVarChar).Value = _MOM_RCPRow.DAIRY;

                if (!_MOM_RCPRow.IsGLUTENNull())
                    momCommand.Parameters.Add("@GLUTEN", SqlDbType.NVarChar).Value = _MOM_RCPRow.GLUTEN;

                if (!_MOM_RCPRow.IsNUTNull())
                    momCommand.Parameters.Add("@NUT", SqlDbType.NVarChar).Value = _MOM_RCPRow.NUT;

                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;

                MOMDataset momDataSet = new MOMDataset();

                adapter.TableMappings.Add("Table", momDataSet.MOM_RCP_SEARCH.TableName);

                adapter.Fill(momDataSet);

                _MOM_RCP_SEARCHDataTable = momDataSet.MOM_RCP_SEARCH;

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
