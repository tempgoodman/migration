CREATE TABLE application (
id UUID DEFAULT uuid_generate_v4() PRIMARY KEY,
  loan_no VARCHAR(255),
  model VARCHAR(255),
  apply_no varchar(255),
  loan_status varchar(255),
  loan_type_id VARCHAR(255),
  newloan_no VARCHAR(255),
repayment_cycle VARCHAR(255),
  interest_method VARCHAR(255),
  rate_type VARCHAR(255),
  loan_amount VARCHAR(255),
  installment VARCHAR(255),
  prime_rate_vary VARCHAR(255),
  flat_rate VARCHAR(255),
  interest_rate VARCHAR(255),
  installment_amount VARCHAR(255),
  maxint_max_total_interest VARCHAR(255),
maxint_total_interest VARCHAR(255),
apply_date VARCHAR(255),
loan_purpose_id VARCHAR(255),
loan_branch VARCHAR(255),
loan_staff VARCHAR(255),
agent_id VARCHAR(255),
agent_address VARCHAR(255),
agent_relation VARCHAR(255),
main_avenue_id VARCHAR(255),
main_purpose_id VARCHAR(255),
loan_upload VARCHAR(255)
customer_id UUID,
autopay UUID,
customer_career_id UUID,
other_information UUID
);

create table customer(   
    id UUID DEFAULT uuid_generate_v4() PRIMARY KEY,
    name VARCHAR(255),
    customer_type VARCHAR(255),
    director_name VARCHAR(255),
    birth_date VARCHAR(255),
    age VARCHAR(255),
    passport_no VARCHAR(255),
    mobile_no VARCHAR(255),
    mobile_no2 VARCHAR(255),
    mobile_no3 VARCHAR(255),
    home_no VARCHAR(255),
    email VARCHAR(255),
    marital_status VARCHAR(255),
    education VARCHAR(255),
    flat_address VARCHAR(255),
    flat_address_district_id VARCHAR(255),
    mailing_address VARCHAR(255),
    mailing_address_district_id VARCHAR(255),
    flat_type_id VARCHAR(255),
    gender VARCHAR(255),
    customer_career_id UUID
)


create table autopay(
    id UUID DEFAULT uuid_generate_v4() PRIMARY KEY,
    autopay_ref_no VARCHAR(255),
    autopay_bank VARCHAR(255),
    autopay_account_name VARCHAR(255),
    autopay_bank_code VARCHAR(255),
    autopay_branch_code VARCHAR(255),
    autopay_account_no VARCHAR(255)
)


create table customer_career(
    id UUID DEFAULT uuid_generate_v4() PRIMARY KEY,
    occupy_from VARCHAR(255),
    occupy_duration_year VARCHAR(255),
    occupy_with_remark VARCHAR(255),
    company_name VARCHAR(255),
    company_address VARCHAR(255),
    company_address_district_id VARCHAR(255),
    office_no VARCHAR(255),
    direct_line_no VARCHAR(255),
    fax_no VARCHAR(255),
    occupation_id VARCHAR(255),
    industry VARCHAR(255),
    department VARCHAR(255),
    position VARCHAR(255),
    employment_type VARCHAR(255),
    work_from VARCHAR(255),
    work_duration_year VARCHAR(255),
    salary VARCHAR(255),
    income_proof VARCHAR(255)
)

create other_information(
    id UUID DEFAULT uuid_generate_v4() PRIMARY KEY,
    source_id VARCHAR(255),
    source_remark VARCHAR(255),
    decline_loan_log VARCHAR(255),
    remark VARCHAR(255)
)
